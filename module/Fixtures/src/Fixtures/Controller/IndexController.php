<?php

namespace Fixtures\Controller;

use Fixtures\Model;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Fixtures\Model\Matches;
use Fixtures\Model\Points;
use Fixtures\Model\Clubs;
use Zend\Db\TableGateway\TableGateway;
use Fixtures\Form\FixturesForm;

use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{ 
	protected $matchesTable;
    protected $pointsTable;
    protected $clubsTable;

    public function indexAction()
    {
        $this->layout('layout/layout-fixtures.phtml');
        $fix = $this->getMatchesTable()->getAllByRound();        
        $round = $this->getMatchesTable()->getRounds(); 
        return new ViewModel(array('fix'    => $fix,
                                   'round'  => $round
        ));  
    }      

    public function getMatchesTable()
    {
        if (!$this->matchesTable) {
            $sm = $this->getServiceLocator();
            $this->matchesTable = $sm->get('Fixtures\Model\MatchesTable');
        } 
        return $this->matchesTable;
    } 

    public function getPointsTable()
    {
        if (!$this->pointsTable) {
            $sm = $this->getServiceLocator();
            $this->pointsTable = $sm->get('Fixtures\Model\PointsTable');
        } 
        return $this->pointsTable;
    } 

    public function getClubsTable()
    {
        if (!$this->clubsTable) {
            $sm = $this->getServiceLocator();
            $this->clubsTable = $sm->get('Fixtures\Model\ClubsTable');
        } 
        return $this->clubsTable;
    }     

    public function addManyAction()
    {
        $this->layout('layout/layout-fixtures.phtml');
        $form = new FixturesForm();
        return array('form' => $form);
    }

    public function ajaxAddManyAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()){                    
            $round = $this->getRequest()->getPost('round'); 
            $matches = $this->getRequest()->getPost('content');
            $matchesInContent = explode("\n", $matches);
            $countMatches = count($matchesInContent);
            $matchesArray = array(); 
            for ($i=0; $i < $countMatches; $i++) { 
                $club = explode('-', trim($matchesInContent[$i]));
                if (empty($club[0]) || empty($club[1])) {
                    $result = new JsonModel(array('wynik' => 'fail'));
                    return $result;
                }
                $club[0] = trim($club[0]);
                $club[1] = trim($club[1]);                             
                $homeTeam = $this->getClubsTable()->getIdByClubName($club[0]);               
                $awayTeam = $this->getClubsTable()->getIdByClubName($club[1]);
                $round = trim($round);                
                $matchesArray[$i]['round'] = $round;
                $matchesArray[$i]['home_team'] = $homeTeam->id;
                $matchesArray[$i]['away_team'] = $awayTeam->id;                
            } 
            $idArray = $this->getMatchesTable()->addManyMatches($matchesArray); 
            $this->getPointsTable()->addManyMatches($matchesArray, $idArray);     
            $result = new JsonModel(array(
                    'wynik' => 'success',
                    'test' => $idArray                    
            ));
           return $result;            
        }
        return $this->response;
    }

    public function updateTableAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()){  
            $value = $this->getRequest()->getPost('value');
            $fix = $this->getMatchesTable()->getAllByRound($value);           
            $changedMatches = array();
            

            $result = new JsonModel(array(
                    'wynik' => 'success',
                    'test' => $club->name                    
            ));
            return $result;
        }
        return $this->response;
    }
}