<?php

return array(
	'resources' => array (
		'router' => array (
			'routes' => array (
				'staff' => array (
					'type'  => 'Zend_Controller_Router_Route_Static',
					'route' => 'staff.html',
					'label' => 'Персонал',
					'defaults' => array (
						'module'     => 'staff',
						'controller' => 'index',
						'action'     => 'index',
					),
				),
			),
		),
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
					'pages' => array(
						'default/admin-index/modules' => array (
							'pages' => array(
								'staff/admin-staff/index' => array (
									'id'         => 'staff/admin-staff/index',
									'label'      => 'Персонал',
									'module'     => 'staff',
									'controller' => 'admin-staff',
									'action'     => 'index',
								),
							),
						),
					),
				),
			),
		),
	),
);