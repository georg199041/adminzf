<?php

class Default_AdminIndexController extends Core_Controller_Action
{
	public function init()
	{
		$this->getHelper('layout')->setLayout('admin');
	}
	
	public function indexAction(){}
}