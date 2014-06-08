<?php 
namespace Posts\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class PostsTable
{
	protected $tableGateway;
  
	public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }  

    public function fetchAll1($paginated=false)
	{
		if ($paginated) {		     
		    $select = $this->getallAlbum();
		         
		    $resultSetPrototype = new ResultSet();
		    $resultSetPrototype->setArrayObjectPrototype(new Posts());		     
		    $paginatorAdapter = new DbSelect(		       
		        $select,		        
		        $this->tableGateway->getAdapter(),		       
		        $resultSetPrototype
		    );
		    $paginator = new Paginator($paginatorAdapter);
		    return $paginator;
		}
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}  

	function getallAlbum(){
	    //$sql = new Select();
	    $sql->from('posts')->limit('1');
	    return $sql; 
	}

	public function getById($id)
	{
		$rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        return $row;
	}

	public function changeStatus($id, $newstatus)
	{	
		$data = array(
            'active' => $newstatus            
        );		
		$this->tableGateway->update($data, array('id' => $id));
	}

	public function fetchAll()
    {
        $resultSet = $this->tableGateway->select(function (Select $select) {	     	
	     	$select->order('id DESC');
	    });         
        $resultSet->buffer();    
        return $resultSet; 
    }

    public function deletePost($id)
	{
		$this->tableGateway->delete(array('id' => $id));
	}

	public function addPost(Posts $post)
	{
		$time = date("Y-m-d");
		$time = strtotime($time);

        $name = str_replace(' ', '_', $post->name);
		$data = array(
            'name' => $name,
            'content'  => $post->content,
            'date_created' => $time,
            'file' => $post->file
        );	
        $id = (int) $post->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getById($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } 
        }
	}        
}