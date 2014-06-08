<?php 
namespace Clubs\Model;

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

    public function deleteClub($id)
    {
    	$this->tableGateway->delete(array('id' => $id));
    }

    public function addClub(Clubs $club)
	{		
		$data = array(
            'name' => $club->name,
            'file'  => $club->file           
        );	
        $id = (int) $club->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getById($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } 
        }
	}     
}