<?php    
namespace Fixtures\Model;

class Matches 
{
	// matches
	public $id;
	public $round;
	public $home_team;
	public $away_team;
	public $home_team_goals;
	public $away_team_goals;
	public $date;

	// clubs
	public $name; 
	
	public function exchangeArray($data)
    {
    	$this->id = (!empty($data['id'])) ? $data['id'] : null;   
        $this->round = (!empty($data['round'])) ? $data['round'] : null;      
        $this->home_team = (!empty($data['home_team'])) ? $data['home_team'] : null;       
        $this->away_team = (!empty($data['away_team'])) ? $data['away_team'] : null; 
        $this->home_team_goals = (!empty($data['home_team_goals'])) ? $data['home_team_goals'] : null;
        $this->away_team_goals = (!empty($data['away_team_goals'])) ? $data['away_team_goals'] : null;  
        $this->date = (!empty($data['date'])) ? $data['date'] : null; 

        // clubs  
       $this->name = (!empty($data['name'])) ? $data['name'] : null;              
    }
}