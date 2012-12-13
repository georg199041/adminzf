<?php

class Staff_IndexController extends Core_Controller_Action
{	
	public function init()
	{
		$this->view->headTitle($this->__('Персонал'));
	}
	
	public function indexAction(){}
}
