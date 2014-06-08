<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Posts\Controller\Index' => 'Posts\Controller\IndexController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'posts' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/posts',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Posts\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:action][/:id]',
                            'constraints' => array(                               
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller'    => 'index',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                    'paginator' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[page/:page]',
                            'constraints' => array(
                                'page' => '[0-9]*',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Posts\Controller',
                                'controller'    => 'Index',
                                'action'        => 'index',
                            ),
                        ),
                    ),                   
                ),
            ),          
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'posts' => __DIR__ . '/../view',
        ),
    ),    
);
?>
