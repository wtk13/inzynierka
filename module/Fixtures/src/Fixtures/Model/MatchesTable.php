<?php 
namespace Fixtures\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class MatchesTable
{
	protected $tableGateway;
  
	public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }  

    public function addManyMatches($matchesArray)
	{
		$idArray = array();
		foreach ($matchesArray as $key => $value) {
			$data = array(
            'round' => $value['round'],
            'home_team'  => $value['home_team'],
            'away_team' => $value['away_team'],            
        	);	
        	$home_team = $value['home_team'];
        	$away_team = $value['away_team'];
        	$this->tableGateway->insert($data);
        	$result = $this->tableGateway->select(function(Select $select) use ($home_team, $away_team){
	            $select->columns(array('id'))
	                   ->where(array('home_team' => $home_team))
	                   ->where(array('away_team' => $away_team));                   
	        });
	        $row = $result->current();
	        array_push($idArray, $row->id);  
		}
		return $idArray;
	}  

	public function getAllByRound($round = 1)
	{
		$result = $this->tableGateway->select(function(Select $select) use ($round){
			$select->join(array('c1' => 'clubs'), 'home_team = c1.id', array('home_team' => 'name'))
			       ->join(array('c2' => 'clubs'), 'away_team = c2.id', array('away_team' => 'name'))
			       ->where(array('round' => $round));
		});
		return $result;
	}

	public function getRounds()
	{
		$result = $this->tableGateway->select(function(Select $select) {
			$select->columns(array('round'))
			       ->group('round');
		});
		return $result;
	}
}