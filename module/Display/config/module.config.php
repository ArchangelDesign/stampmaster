<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Display\Controller\Display' => 'Display\Controller\DisplayController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'display-index' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/home',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Display\Controller',
                        'controller'    => 'Display',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Display' => __DIR__ . '/../view',
        ),
    ),
);
