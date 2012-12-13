<?php

return array (
	'appnamespace' => 'Application',
	'phpSettings' => array (
		'display_startup_errors' => '1',
		'display_errors' => '1',
		'default_charset' => 'UTF-8',
		'date' => array (
			'timezone' => 'Europe/Kiev',
		),
		'session' => array (
			'save_path' => ROOT_PATH . '/data/sessions',
		),
		'error_reporting' => /*E_ALL &~E_NOTICE,*/E_WARNING|E_ERROR|E_COMPILE_ERROR|E_COMPILE_WARNING|E_CORE_ERROR|E_CORE_WARNING|E_USER_ERROR|E_USER_WARNING,
	),
	'pluginPaths' => array (
		'Core_Application_Resource'       => 'Core/Application/Resource',
		'Core_Image_Application_Resource' => 'Core/Image/Application/Resource',
		'Core_Block_Application_Resource' => 'Core/Block/Application/Resource',
	),
	'bootstrap' => array (
		'path' => APPLICATION_PATH . '/Bootstrap.php',
		'class' => 'Bootstrap',
	),
	'resources' => array (
		'block' => array(),
		'multidb' => array(
			'default' => array(
				'adapter' => "pdo_mysql",
				'host' => "localhost",
				'username' => "root",
				'password' => "",
				'dbname' => "adminzf",
				'driver_options' => array(
					PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
				),
				'default' => true
			)
		),
		'modules' => array (),
		'frontController' => array (
			'controllerDirectory' => APPLICATION_PATH . '/Controller',
			'moduleControllerDirectoryName' => 'Controller',
			'params' => array (
				'prefixDefaultModule' => true,
				'displayExceptions' => '1',
			),
			'moduleDirectory' => APPLICATION_PATH . '/modules',
		),
		'layout' => array (
			'layoutPath' => APPLICATION_PATH . '/layouts/scripts/',
			'layout' => 'default',
			'viewSuffix' => 'php3',
		),
		'viewRenderer' => array (
			'viewSuffix' => 'php3',
		),
		'view' => array (
			'encoding' => 'utf-8',
			'doctype' => 'HTML5',
			'charset' => 'utf-8',
			'contentType' => 'text/html; charset=utf-8',
			'helperPath' => array (
				'Sunny_View_Helper'       => 'Sunny/View/Helper',
				'Core_View_Helper'        => 'Core/View/Helper'
			),
		),
		'image' => array (),
		'router' => array (
			'routes' => array (
				/*'default' => array (
					'label'        => 'По умолчанию',
					'type'         => 'Zend_Controller_Router_Route',
					'route'        => ':module/:controller/:action/*',
					'reset_params' => true,	
					'order'        => -1000,
					'defaults' => array (
						'module'     => 'default',
						//'controller' => 'index',
						//'action'     => 'index',
					),
				),*/
			),
		),
		'navigation' => array (
			'storage' => array (
				'registry' => '1',
			),
			'pages' => array (
				'frontend' => array (
					'id'    => 'frontend',
					'label' => 'Frontend',
					'type'  => 'Zend_Navigation_Page_Uri',
				),
				'default/admin-index/index' => array (
					'id'         => 'default/admin-index/index',
					'label'      => 'Администратор',
					'module'     => 'default',
					'controller' => 'admin-index',
					'action'     => 'index',
					'pages'      => array(
						'default/admin-index/modules' => array(
							'id'         => 'default/admin-index/modules',
							'type'       => 'Zend_Navigation_Page_Uri',
							'label'      => 'Модули',
						),
					),
				),
			),
		),
	),
);
