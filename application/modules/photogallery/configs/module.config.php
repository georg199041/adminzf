<?php

return array(
	'resources' => array (
		'router' => array (
			'routes' => array (
				'photogallery' => array (
					'type'  => 'Zend_Controller_Router_Route_Static',
					'route' => 'photogallery.html',
					'label' => 'Фотогалерея',
					'defaults' => array (
						'module'     => 'photogallery',
						'controller' => 'index',
						'action'     => 'index',
					),
				),
				'photogallery_album' => array (
					'type'  => 'Zend_Controller_Router_Route_Regex',
					'route' => 'photogallery/(.*).html',
					'label' => 'Фотогалерея - альбом',
					'defaults' => array (
						'module'      => 'photogallery',
						'controller'  => 'index',
						'action'      => 'album',
						'album_alias' => '',
					),
					'map' => array(1 => 'album_alias'),
					'reverse' => 'photogallery/%s.html'
				),
			),
		),
		'cachemanager' => array(
			'resizeToCrop178x120' => array(
				'frontend' => array(
					'name'                 => 'Core_Image_Cache_Frontend_Image',
					'customFrontendNaming' => true,
					'options'              => array(
						'label'                    => 'Кеш картинок c обрезкой до 178x120',
						'lifetime'                 => 3600000,
						'image_master_check_mtime' => true,
						'logging'                  => false,
					),
				),
				'backend'  => array(
					'name'    => 'Core_Image_Cache_Backend_Image',
					'customBackendNaming' => true,
					'options' => array(
						'cache_dir'        => 'cache/resizeToCrop178x120',
						'image_processing' => array(
							array('method' => 'setCompression', 'arguments' => array(85)),
							array('method' => 'resizeToCrop', 'arguments' => array(178, 120)),
						),
					),
				),
			),
			'resizeToCrop104x70' => array(
				'frontend' => array(
					'name'                 => 'Core_Image_Cache_Frontend_Image',
					'customFrontendNaming' => true,
					'options'              => array(
						'label'                    => 'Кеш картинок c обрезкой до 104x70',
						'lifetime'                 => 3600000,
						'image_master_check_mtime' => true,
						'logging'                  => false,
					),
				),
				'backend'  => array(
					'name'                => 'Core_Image_Cache_Backend_Image',
					'customBackendNaming' => true,
					'options' => array(
						'cache_dir'        => 'cache/resizeToCrop104x70',
						'image_processing' => array(
							array('method' => 'setCompression', 'arguments' => array(85)),
							array('method' => 'resizeToCrop', 'arguments' => array(104, 70)),
						),
					),
				),
			),
			'resizeToWidth570' => array(
				'frontend' => array(
					'name'                 => 'Core_Image_Cache_Frontend_Image',
					'customFrontendNaming' => true,
					'options'              => array(
						'label'                    => 'Кеш картинок c шириной 570',
						'lifetime'                 => 3600000,
						'image_master_check_mtime' => true,
						'logging'                  => false,
					),
				),
				'backend'  => array(
					'name'                => 'Core_Image_Cache_Backend_Image',
					'customBackendNaming' => true,
					'options' => array(
						'cache_dir'        => 'cache/resizeToWidth570',
						'image_processing' => array(
							array('method' => 'setCompression', 'arguments' => array(70)),
							array('method' => 'resizeToWidth', 'arguments' => array(570)),
						),
					),
				),
			),
		),
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
					'pages' => array(
						'photogallery/admin-images/index' => array (
							'id'         => 'photogallery/admin-images/index',
							'label'      => 'Фотогалерея',
							'module'     => 'photogallery',
							'controller' => 'admin-images',
							'action'     => 'index',
							'pages' => array(
								'photogallery/admin-albums/index' => array (
									'id'         => 'photogallery/admin-albums/index',
									'label'      => 'Альбомы фотогалереи',
									'module'     => 'photogallery',
									'controller' => 'admin-albums',
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