<?php

require_once 'Core/Application/Module/Bootstrap.php';

class Photogallery_Bootstrap extends Core_Application_Module_Bootstrap
{    
    public function _initCache()
    {
    	/*$frontend = new Zend_Cache_Core(array(
   			'automatic_serialization' => true,
   			'lifetime'                => 86400,
   			//'logging'  => $cahceLogging,
   			//'logger'   => $logger,
   			//'caching'  => (bool) $this->getOption('enable_cache_metadata')
    	));
    	
    	//if (extension_loaded('apc')) {
    	//	$backend = new Zend_Cache_Backend_Apc();
    	//} else {
    		$backend = new Zend_Cache_Backend_File(array('cache_dir' => ROOT_PATH . '/data/cache'));
    	//}*/
    	
    	Core_Block_View::setCache(
	    	Zend_Cache::factory(
		    	'Core', 
		    	'File',
		    	array(
	    			'automatic_serialization' => true,
	    			'lifetime'                => 86400,
	    			//'logging'                 => $cahceLogging,
	    			//'logger'                  => $logger,
	    			//'caching'                 => (bool) $this->getOption('enable_cache_metadata')
		    	),
		    	array(
		    		'cache_dir' => ROOT_PATH . '/data/cache'
		    	)
	    	)
    	);
    }
}
