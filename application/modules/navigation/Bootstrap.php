<?php

require_once 'Core/Application/Module/Bootstrap.php';

class Navigation_Bootstrap extends Core_Application_Module_Bootstrap
{    
    public function _initPlugins()
    {
    	$this->bootstrap('frontController');
    	$front = $this->getResource('frontController');
    	$front->registerPlugin(new Navigation_Controller_Plugin_Navigation());
    }
}
