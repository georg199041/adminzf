<?php

return array(
	'resources' => array (
		'router' => array (
			'routes' => array (
				'contents-static' => array (
					'type'     => 'Zend_Controller_Router_Route_Regex',
					'route'    => 'contents/(.*).html',
					'label'    => 'Статический контент',
					'defaults' => array (
						'module'     => 'contents',
						'controller' => 'index',
						'action'     => 'view-static',
					),
					'map'     => array(1 => 'alias'),
					'reverse' => 'contents/%s.html',
				),
			),
		),
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
					'pages' => array(
						'contents/admin-posts/index' => array (
							'id'         => 'contents/admin-posts/index',
							'label'      => 'Контент',
							'module'     => 'contents',
							'controller' => 'admin-posts',
							'action'     => 'index',
							'pages' => array(
								'contents/admin-categories/index' => array (
									'id'         => 'contents/admin-categories/index',
									'label'      => 'Категории контента',
									'module'     => 'contents',
									'controller' => 'admin-categories',
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