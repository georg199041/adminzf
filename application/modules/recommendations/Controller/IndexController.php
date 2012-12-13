<?php

class Recommendations_IndexController extends Core_Controller_Action
{	
	public function init()
	{
		$this->view->headTitle($this->__('Рекомендации'));
	}
	
	public function indexAction(){}
}
