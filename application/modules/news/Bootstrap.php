<?php

require_once 'Core/Application/Module/Bootstrap.php';

class News_Bootstrap extends Core_Application_Module_Bootstrap
{
	public function _initCache()
	{
		Core_Block_View::setCache(
			Zend_Cache::factory(
				'Core',
				'File',
				array(
					'automatic_serialization' => true,
					'lifetime'				  => 86400,
				),
				array(
					'cache_dir' => ROOT_PATH . 'data/cache'
				)
			)
		);
	}
}