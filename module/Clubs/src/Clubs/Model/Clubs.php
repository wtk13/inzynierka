<?php    
namespace Clubs\Model;

class Clubs 
{
	public $id;	
	public $name;
	public $file;		
	
	public function exchangeArray($data)
    {
    	$this->id = (!empty($data['id'])) ? $data['id'] : null;     
        $this->name = (!empty($data['name'])) ? $data['name'] : null;    
        $this->file = (!empty($data['file'])) ? $data['file'] : null;               
    }
}