<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Admin' => 'Admin\Controller\AdminController',
            'Admin\Controller\Config' => 'Admin\Controller\ConfigController',
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

            'add-stamp-type' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/add-stamp-type',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Admin',
                        'action'        => 'addStampType',
                    ),
                ),
                'may_terminate' => true,
            ),

			'edit-stamp-type' => array(
				'type'	=> 'Literal',
				'options' => array(
					'route'    => '/admin/edit-stamp-type',
					'defaults' => array(
						'__NAMESPACE__' => 'Admin\Controller',
						'controller'    => 'Admin',
						'action'        => 'editStampType',
					),
				),
			),

            /* Configuration */

            'config-general' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/general-configuration',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Config',
                        'action'        => 'generalConfig',
                    ),
                ),
                'may_terminate' => true,
            ),

            'config-set-value' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/set-config-value',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Config',
                        'action'        => 'setConfigValue',
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
