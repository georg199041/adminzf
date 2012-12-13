<?php

return array(
	'resources' => array (
		'router' => array (
			'routes' => array (
				'recommendations' => array (
					'type'  => 'Zend_Controller_Router_Route_Static',
					'route' => 'recommendations.html',
					'label' => 'Рекомендации',
					'defaults' => array (
						'module'     => 'recommendations',
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
								'recommendations/admin-posts/index' => array (
									'id'         => 'recommendations/admin-posts/index',
									'label'      => 'Рекоммендации',
									'module'     => 'recommendations',
									'controller' => 'admin-posts',
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