<?php

return array(
	'resources' => array (
		'router' => array (
			'routes' => array (
				'contacts' => array (
					'type'  => 'Zend_Controller_Router_Route_Static',
					'route' => 'contacts.html',
					'label' => 'Контакты',
					'defaults' => array (
						'module'     => 'contacts',
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
						'contacts/admin-contacts/index' => array (
							'id'         => 'contacts/admin-contacts/index',
							'label'      => 'Контакты',
							'module'     => 'contacts',
							'controller' => 'admin-contacts',
							'action'     => 'index',
							'pages'      => array(
								'contacts/admin-groups/index' => array(
									'id'         => 'contacts/admin-groups/index',
									'label'      => 'Группы контактов',
									'module'     => 'contacts',
									'controller' => 'admin-groups',
									'action'     => 'index',
								),
								'contacts/admin-feedback/index' => array(
									'id'         => 'contacts/admin-feedback/index',
									'label'      => 'Обратная связь',
									'module'     => 'contacts',
									'controller' => 'admin-feedback',
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