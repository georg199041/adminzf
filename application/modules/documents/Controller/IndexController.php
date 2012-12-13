<?php

class Documents_IndexController extends Core_Controller_Action
{	
	public function init()
	{
		$this->view->headTitle($this->__('Документы'));
	}
	
	public function indexAction(){}
}
