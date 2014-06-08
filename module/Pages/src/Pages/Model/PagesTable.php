<?php 
namespace Pages\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class PagesTable
{
	protected $tableGateway;
  
	public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getPages()
	{
		$result = $this->tableGateway->select();
        return $result;
	}

	public function getPage($id)
	{
	     $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
	}

	public function deletePage($id)
	{
		$this->tableGateway->delete(array('id' => $id));
	}

	public function addPage(Pages $page){
		$time = date("Y-m-d");
		$time = strtotime($time);

        $name = str_replace(' ', '_', $page->name);
		$data = array(
            'name' => $name,
            'content'  => $page->content,
            'date_created' => $time,
            'file' => $page->file
        );	
        $id = (int) $page->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getPage($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Album id does not exist');
            }
        }
	}        
}