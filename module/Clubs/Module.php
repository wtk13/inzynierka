<?php

namespace Clubs;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Clubs\Model\Clubs;
use Clubs\Model\ClubsTable;

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
                'Clubs\Model\ClubsTable' =>  function($sm) {
                    $tableGateway = $sm->get('ClubsTableGateway');
                    $table = new ClubsTable($tableGateway);
                    return $table;
                },
                 'ClubsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Clubs());
                    return new TableGateway('clubs', $dbAdapter, null, $resultSetPrototype);
                },                                     
            ),
        );
    }      
}