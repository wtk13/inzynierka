<?php
namespace Pages;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Pages\Model\Pages;
use Pages\Model\PagesTable;

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
                'Pages\Model\PagesTable' =>  function($sm) {
                    $tableGateway = $sm->get('PagesTableGateway');
                    $table = new PagesTable($tableGateway);
                    return $table;
                },
                 'PagesTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Pages());
                    return new TableGateway('pages', $dbAdapter, null, $resultSetPrototype);
                },                                     
            ),
        );
    }  
}