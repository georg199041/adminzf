<?php

return array(
	'resources' => array (
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
					'pages' => array(
						'default/admin-index/modules' => array (
							'pages' => array(
								'comments/admin-comments/index' => array (
									'id'         => 'comments/admin-comments/index',
									'label'      => 'Комментарии',
									'module'     => 'comments',
									'controller' => 'admin-comments',
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