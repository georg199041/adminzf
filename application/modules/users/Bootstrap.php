<?php

require_once 'Core/Application/Module/Bootstrap.php';

class Users_Bootstrap extends Core_Application_Module_Bootstrap
{    
	public function _initPlugins()
	{
		$this->bootstrap('frontController');
		$front = $this->getResource('frontController');
		$front->registerPlugin(new Users_Controller_Plugin_Auth(array(
			'route' => 'users/admin-users/login',
			'excludedResources' => array('users/admin-users/login'),
		)));
	}
}
