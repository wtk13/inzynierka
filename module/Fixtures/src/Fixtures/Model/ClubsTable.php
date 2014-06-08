<?php 
namespace Fixtures\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class ClubsTable
{
	protected $tableGateway;
  
	public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }  

    public function getClubs()
    {
    	$result = $this->tableGateway->select();
        return $result;
    }

    public function getById($id)
	{
		$rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        return $row;
	}

    public function getIdByClubName($name)
    {
        $result = $this->tableGateway->select(function(Select $select) use ($name){
            $select->columns(array('id'))
                   ->where(array('name' => $name));                   
        });
        $row = $result->current();
        return $row;      
    }     
}