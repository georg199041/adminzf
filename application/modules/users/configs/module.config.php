<?php

return array(
	'resources' => array (
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
					'pages' => array(
						'users/admin-users/index' => array (
							'id'         => 'users/admin-users/index',
							'label'      => 'Пользователи',
							'module'     => 'users',
							'controller' => 'admin-users',
							'action'     => 'index',
						),
					),
				),
			),
		),
	),
);