<?php

return array(
	'resources' => array (
		'router' => array (
			'routes' => array (
				'documents' => array (
					'type'  => 'Zend_Controller_Router_Route_Static',
					'route' => 'documents.html',
					'label' => 'Документы',
					'defaults' => array (
						'module'     => 'documents',
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
								'documents/admin-posts/index' => array (
									'id'         => 'documents/admin-posts/index',
									'label'      => 'Документы',
									'module'     => 'documents',
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