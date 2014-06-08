<?php
namespace Posts;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Posts\Model\Posts;
use Posts\Model\PostsTable;

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
                'Posts\Model\PostsTable' =>  function($sm) {
                    $tableGateway = $sm->get('PostsTableGateway');
                    $table = new PostsTable($tableGateway);
                    return $table;
                },
                 'PostsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Posts());
                    return new TableGateway('posts', $dbAdapter, null, $resultSetPrototype);
                },                                     
            ),
        );
    }  
}