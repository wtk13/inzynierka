<?php
namespace Fixtures;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Fixtures\Model\Matches;
use Fixtures\Model\MatchesTable;
use Fixtures\Model\Points;
use Fixtures\Model\PointsTable;
use Fixtures\Model\Clubs;
use Fixtures\Model\ClubsTable;

class Module
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }  

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Fixtures\Model\MatchesTable' =>  function($sm) {
                    $tableGateway = $sm->get('MatchesTableGateway');
                    $table = new MatchesTable($tableGateway);
                    return $table;
                },
                 'MatchesTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Matches());
                    return new TableGateway('matches', $dbAdapter, null, $resultSetPrototype);
                },
                'Fixtures\Model\PointsTable' =>  function($sm) {
                    $tableGateway = $sm->get('PointsTableGateway');
                    $table = new PointsTable($tableGateway);
                    return $table;
                },
                 'PointsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Points());
                    return new TableGateway('points', $dbAdapter, null, $resultSetPrototype);
                },
                'Fixtures\Model\ClubsTable' =>  function($sm) {
                    $tableGateway = $sm->get('ClubsTableGatewayForFixtures');
                    $table = new ClubsTable($tableGateway);
                    return $table;
                },
                'ClubsTableGatewayForFixtures' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Clubs());
                    return new TableGateway('clubs', $dbAdapter, null, $resultSetPrototype);
                },                                           
            ),
        );
    }  
}