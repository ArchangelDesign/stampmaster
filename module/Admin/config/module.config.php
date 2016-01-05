<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Admin' => 'Admin\Controller\AdminController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'admin-dashboard' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/dashboard',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Admin',
                        'action'        => 'dashboard',
                    ),
                ),
                'may_terminate' => true,
            ),

            'admin-orders' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/orders',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Admin',
                        'action'        => 'orders',
                    ),
                ),
                'may_terminate' => true,
            ),

            'admin-stamp-types' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/stamp-types',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Admin',
                        'action'        => 'stampTypes',
                    ),
                ),
                'may_terminate' => true,
            ),

            'admin-stamp-types-data' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/fetch-stamp-types',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Admin',
                        'action'        => 'fetchStampTypes',
                    ),
                ),
                'may_terminate' => true,
            ),

        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Admin' => __DIR__ . '/../view',
        ),
    ),
);
