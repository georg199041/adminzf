<?php

clearstatcache();

/* Define project root path OK */
if (!defined('ROOT_PATH')) {
	define('ROOT_PATH', realpath(dirname(dirname(dirname(__FILE__)))));
}

/* Define project application path OK */
if (!defined('APPLICATION_PATH')) {
	define('APPLICATION_PATH', realpath(ROOT_PATH . '/application'));
}

/* Define ZEND library(s) OK */
if (!defined('LIBRARY_PATH')) {
	if (file_exists(realpath(ROOT_PATH . '/../../phpLibs'))) {
		$libraryPath[] = realpath(ROOT_PATH . '/../../phpLibs');
	}
	
	if (file_exists(realpath(ROOT_PATH . '/../../Zend_Framework'))) {
		$libraryPath[] = realpath(ROOT_PATH . '/../../Zend_Framework');
	}
	
	$libraryPath[] = realpath(ROOT_PATH . '/library');
	define('LIBRARY_PATH', implode(PATH_SEPARATOR, $libraryPath));
	unset($libraryPath);
}

/* Define public path */
if (!defined('PUBLIC_PATH')) {
	define('PUBLIC_PATH', realpath(dirname(__FILE__)));
}

/* Define env */
if (!defined('APPLICATION_ENV')) {
    define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
}

/* Add paths to php_include_path */
set_include_path(
	implode(PATH_SEPARATOR, 
		array(
    		LIBRARY_PATH,
    		get_include_path(),
    	)
    )
);

/* Safe mode include path set */
ini_set('safe_mode_include_dir', str_replace('\\', '/', get_include_path()));

/* Load config  */
require_once APPLICATION_PATH . '/configs/config.php';

require_once 'Zend/Session.php';
require_once 'Zend/Auth.php';
require_once 'Zend/Auth/Storage/Session.php';

$sess = new Zend_Session_Namespace(Zend_Auth_Storage_Session::NAMESPACE_DEFAULT);

Zend_Session::$_unitTestEnabled = false;

/* Load Zend_Application */
require_once 'Zend/Application.php';
