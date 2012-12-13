<?php

return array(
	'resources' => array (
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
					'pages' => array(
						'default/admin-index/frontpage' => array (
							'pages' => array(
								'frontpage/admin-recovery-system/index' => array (
									'id'         => 'frontpage/admin-recovery-system/index',
									'label'      => 'Схема "Система восстановления"',
									'module'     => 'frontpage',
									'controller' => 'admin-recovery-system',
									'action'     => 'index',
								),
								'frontpage/admin-slider/index' => array (
									'id'         => 'frontpage/admin-slider/index',
									'label'      => 'Слайдер',
									'module'     => 'frontpage',
									'controller' => 'admin-slider',
									'action'     => 'index',
								),
								'frontpage/admin-text/index' => array (
									'id'         => 'frontpage/admin-text/index',
									'label'      => 'Текст на главной',
									'module'     => 'frontpage',
									'controller' => 'admin-text',
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