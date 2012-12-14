<?php

class Default_ErrorController extends Core_Controller_Action
{
	/**
	 * Initialize error action for work with ajax
	 * 
	 * (non-PHPdoc)
	 * @see Zend_Controller_Action::init()
	 */
	public function init()
	{
        $context = $this->_helper->AjaxContext();
        $context->addActionContext('error', 'json');
        $context->initContext('json');
        $this->getHelper('layout')->setLayout('e404');
	}

	/**
	 * Main error action
	 */
    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        
        if (!$errors) {
            $this->view->message = 'You have reached the error page';
            return;
        }
        
        $this->view->exceptionCode = $errors->exception->getCode();
        $this->view->exceptionFile = $errors->exception->getFile();
        $this->view->exceptionLine = $errors->exception->getLine();
        $this->view->exceptionMessage = $errors->exception->getMessage();
        
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
        
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->message = 'Page not found';
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $this->view->message = 'Application error';
                break;
        }
        
        // Log exception, if logger available
        if ($log = $this->getLog()) {
            $log->crit($this->view->message, $errors->exception);
        }
        
        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }
        
        $this->view->request = $errors->request;
        
        $this->view->profilers = array();
        /*$adapters = Zend_Registry::get(Bootstrap::MULTIDB_REGISTRY_KEY);
        foreach ($adapters as $adapterName => $adapter) {
        	$this->view->profilers[$adapterName] = $adapter->getProfiler();
        }*/
    }
	
    /**
     * Log errors
     */
    public function getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }
    
    /**
     * Authentification error page
     */
    public function authorizationErrorAction()
    {
    	
    }
    
    /**
     * Acess error page
     */
    public function aclErrorAction()
    {
    	
    }
}

