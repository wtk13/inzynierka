<?php    
namespace Fixtures\Model;

class Points 
{
	public $id;
	public $match_id;
	public $club_id;
	public $points;
	
	
	public function exchangeArray($data)
    {
    	$this->id = (!empty($data['id'])) ? $data['id'] : null;   
        $this->match_id = (!empty($data['match_id'])) ? $data['match_id'] : null;      
        $this->club_id = (!empty($data['club_id'])) ? $data['club_id'] : null;       
        $this->points = (!empty($data['points'])) ? $data['points'] : '';                       
    }
}