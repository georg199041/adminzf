<?php

// Define project root path
if (!defined('ROOT_PATH')) {
	define('ROOT_PATH', realpath(dirname(dirname(__FILE__))));
}

// Define project application path
if (!defined('APPLICATION_PATH')) {
	define('APPLICATION_PATH', ROOT_PATH . '/application');
}

// Define ZEND library(s)
if (!defined('LIBRARY_PATH')) {
	$libs  = array(ROOT_PATH . '/library');
	$paths = array('W:/htdocs/zf1clean-lib', 'W:/Apache2/htdocs/zf1clean-lib', '/home/jenya/www/zf1clean-lib', '/var/www/zf1clean-Lib', 'W:/home/zf1clean-Lib');
	
	foreach ($paths as $path) {
		if (file_exists($path) && is_dir($path)) {
			$libs[] = $path;
			break;
		}
	}
	
	define('LIBRARY_PATH', implode(PATH_SEPARATOR, $libs));
	unset($libs, $paths, $path);
}

// Define public path
if (!defined('PUBLIC_PATH')) {
	define('PUBLIC_PATH', realpath(dirname(__FILE__)));
}

// Define Application data path
if (!defined('APPLICATION_DATA_PATH')) {
	define('APPLICATION_DATA_PATH', ROOT_PATH . '/data');
}

// Define env
if (!defined('APPLICATION_ENV')) {
    define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
}

// Add paths to php_include_path
set_include_path(
	implode(PATH_SEPARATOR, 
		array(
    		LIBRARY_PATH,
    		get_include_path(),
    		'W:/home/ZEND',
    	)
    )
);

// !!! WARNING: loggining must be setup before all processing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Preconfigure fallback autoloader
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);

// Load Zend_Application
require_once 'Zend/Application.php';

// Compile configs
require_once 'Zend/Registry.php';
require_once 'Core/Config/Autoloader.php';
clearstatcache();
$config = Core_Config_Autoloader::load(APPLICATION_PATH, array('/config\.php$/i', '/config\.dev\.php$/i'));
Zend_Registry::set('config', $config);

// Run Zend_Application
$application = new Zend_Application(APPLICATION_ENV, $config);
$application->bootstrap()->run();
