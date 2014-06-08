<?php    
namespace Pages\Model;

class Pages 
{
	public $id;
	public $date_created;
	public $name;
	public $content;
	public $file;	
	
	public function exchangeArray($data)
    {
    	$this->id = (!empty($data['id'])) ? $data['id'] : null;   
        $this->date_created = (!empty($data['date_created'])) ? $data['date_created'] : null;      
        $this->name = (!empty($data['name'])) ? $data['name'] : null;       
        $this->content = (!empty($data['content'])) ? $data['content'] : null; 
        $this->file = (!empty($data['file'])) ? $data['file'] : '';                  
    }
}