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
                    'route'    => '/home',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Display\Controller',
                        'controller'    => 'Display',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            'order-begin' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/order-begin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Display\Controller',
                        'controller'    => 'Display',
                        'action'        => 'orderBegin',
                    ),
                ),
                'may_terminate' => true,
            ),
            'register-user' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/register-user',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Display\Controller',
                        'controller'    => 'Display',
                        'action'        => 'registerUser',
                    ),
                ),
                'may_terminate' => true,
            ),

            'login-user' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Display\Controller',
                        'controller'    => 'Display',
                        'action'        => 'loginUser',
                    ),
                ),
                'may_terminate' => true,
            ),

            'logout-user' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/logout',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Display\Controller',
                        'controller'    => 'Display',
                        'action'        => 'logoutUser',
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
