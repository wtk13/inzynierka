<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Clubs\Controller\Index' => 'Clubs\Controller\IndexController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'clubs' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/clubs[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Clubs\Controller\Index',
                        'action'     => 'index',                                              
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'clubs' => __DIR__ . '/../view',
        ),
    ),
    
);
?>
