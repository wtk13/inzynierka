<?php

namespace Clubs\Controller;

use Clubs\Model;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Clubs\Model\Clubs;
use Zend\Db\TableGateway\TableGateway;
use Clubs\Form\ClubsForm;

class IndexController extends AbstractActionController
{
	protected $clubsTable;

	public function getClubsTable()
    {
        if (!$this->clubsTable) {
            $sm = $this->getServiceLocator();
            $this->clubsTable = $sm->get('Clubs\Model\ClubsTable');
        } 
        return $this->clubsTable;
    }

    public function indexAction()
    {
       $this->layout('layout/layout-clubs.phtml');
       $clubs = $this->getClubsTable()->getClubs();
       return new ViewModel(array('clubs' => $clubs));
    }

    public function deleteAction()
    {            
        $request = $this->getRequest();
        if ($request->isPost()){             
            $id = $this->getRequest()->getPost('id');
            $this->getClubsTable()->deleteClub($id);
            $tablica['wynik'] = 'success';
            echo json_encode($tablica);         
        }
        return $this->response;
    } 

    public function addAction()
    {
       $this->layout('layout/layout-clubs.phtml');
       $form = new ClubsForm();
       $request = $this->getRequest();
        if ($request->isPost()) {
            $club = new Clubs();            
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $club->exchangeArray($form->getData());
                $this->getClubsTable()->addClub($club);                
                return $this->redirect()->toRoute('clubs');
            }
        }
       return array('form' => $form);
    }

    public function editAction()
    {
        $this->layout('layout/layout-clubs.phtml');
        $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('clubs', array(
                 'action' => 'add'
             ));
         }
         try {
             $club = $this->getClubsTable()->getById($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('clubs', array(
                 'action' => 'index'
             ));
         }

         $form  = new ClubsForm();         
         $data = array(
            'name' => $club->name,
            'id' => $club->id,            
            'file' => $club->file
        );
         $form->setData($data);
         $form->get('submit')->setAttribute('value', 'Edytuj');         

         $request = $this->getRequest();
         if ($request->isPost()) {             
             $form->setData($request->getPost());
             if ($form->isValid()) {
                $club->exchangeArray($form->getData());
                $this->getClubsTable()->addClub($club);                
                return $this->redirect()->toRoute('clubs');
             }
         }
         return array(
             'id' => $id,
             'form' => $form,
             'photo' => $club->file
         );
    } 

    public function uploadifyAjaxAction(){
        $targetFolder = 'public/img/clubs';         
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];            
            $targetFile = rtrim($targetFolder,'/') . '/' . $_FILES['Filedata']['name'];
            move_uploaded_file($tempFile,$targetFile);            
            echo '1';          
        }
        return $this->response;
    }

    public function checkExistPhotoAjaxAction()
    { 
      if($this->getRequest()->isPost()){
       $a = $this->getRequest()->getPost("filename");
       $targetFolder = 'public/img/clubs'; 
       if (file_exists($targetFolder . '/' . $a)) {
        echo '1';
       } else {
        echo '0';
       }
      }
      return $this->response;
    }    
}