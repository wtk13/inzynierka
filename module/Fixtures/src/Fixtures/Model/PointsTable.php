<?php 
namespace Fixtures\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class PointsTable
{
	protected $tableGateway;
  
	public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }    

    public function addManyMatches($matchesArray, $idArray)
	{
		$i = 0;
		foreach ($matchesArray as $key => $value) {
			$data = array(
				'club_id'  => $value['home_team'],
				'match_id' => $idArray[$i]
			);		
			$this->tableGateway->insert($data);

			$data1 = array(
				'club_id'  => $value['away_team'],
				'match_id' => $idArray[$i]
			);		
			$this->tableGateway->insert($data1);
			$i++;
		}
	}
}