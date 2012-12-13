<?php

require_once 'Bootstrap.php';

require_once 'Zend/Test/PHPUnit/ControllerTestCase.php';

class ControllerTestCaseAbstract extends Zend_Test_PHPUnit_ControllerTestCase
{
    /**
     * Internal application container
     * 
     * @var mixed
     */
	protected $_application;
	
	/**
	 * Setting up apllication for testing
	 * 
	 * (non-PHPdoc)
	 * @see Zend_Test_PHPUnit_ControllerTestCase::setUp()
	 */
	public function setUp()
	{		
		$this->bootstrap = array($this, 'applicationBootstrap');		
        parent::setUp();
	}
	
	/**
	 * Bootstraping testing application
	 */
	public function applicationBootstrap()
	{
        
		// Assign and instantiate in one step:
		require APPLICATION_PATH . '/configs/config.php';
		
		$this->_application = new Zend_Application(APPLICATION_ENV, $config);
		$this->_application->bootstrap();        
	    
	    /**
         * Fix for ZF-8193
         * http://framework.zend.com/issues/browse/ZF-8193
         * Zend_Controller_Action->getInvokeArg('bootstrap') doesn't work
         * under the unit testing environment.
         */
        $front = Zend_Controller_Front::getInstance();
        $front->setParam('noViewRenderer', true);
        
        if($front->getParam('bootstrap') === null) {
            $front->setParam('bootstrap', $this->_application->getBootstrap());
        }
	}
}