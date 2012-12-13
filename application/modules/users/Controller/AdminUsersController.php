<?php

class Users_AdminUsersController extends Core_Controller_Action
{
	public function init()
	{
		$this->getHelper('layout')->setLayout('admin');
		if (Zend_Auth::getInstance()->hasIdentity()) {
			$this->view->headTitle('Пользователи');
		}
	}
	
	public function indexAction(){}
	
	public function loginAction()
	{
		$form = Core::getBlock('users/admin-users/login');
		if (($data = $this->getRequest()->getPost())) {
			try {
				if (!$form->isValid($data)) {
					Core::getSession('admin')->formHasErrors = true;
					throw new Exception($this->__("Invalid form"));
				}
				
				unset(Core::getSession('admin')->formData);
			
				Core::getBlock('application/admin/messenger')->addSuccess($this->__('Добро пожаловать'));
				$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('default/admin-index/index'));
				return;
			} catch (Exception $e) {
				Core::getSession('admin')->formData = $data;
				Core::getBlock('application/admin/messenger')->addError($this->__('Ошика'));
				$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/*'));
				return;
			}
		}
	}
	
	public function logoutAction()
	{
		Zend_Auth::getInstance()->clearIdentity();
		$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('default/admin-index/index'));
	}

	public function editAction()
	{
		$id    = $this->getRequest()->getParam('id');
		$model = Core::getMapper('users/users')->find($id);
		 
		if ($model->getId() || $id == 0) {
			Zend_Registry::set('form_data', $model);
			return;
		}
		 
		Core::getBlock('application/admin/messenger')->addError($this->__('Запись не найдена'));
		$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
	}
	
	public function saveAction()
	{
    	if (($data = $this->getRequest()->getPost()) && !$this->getRequest()->getParam('cancel')) {
    		try {
    			$form = Core::getBlock('users/admin-users/edit');
    			if (!$form->isValid($data)) {
    				Core::getSession('admin')->formHasErrors = true;
    				throw new Exception($this->__("Invalid form"));
    			}
    			
    			$model = Core::getMapper('users/users')->create($form->getValues());
    			$model->save();
    			unset(Core::getSession('admin')->formData);
    	   
    			Core::getBlock('application/admin/messenger')->addSuccess($this->__('Запись сохранена'));
    			if ($this->getRequest()->getParam('back')) {
    				$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/edit/id/' . $model->getId()));
    			}
    	   
    			$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
    			return;
    		} catch (Exception $e) {
    			Core::getSession('admin')->formData = $data;
    			Core::getBlock('application/admin/messenger')->addError($this->__('Ошибка сохранения'.$e->getMessage()));
    			$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/edit/id/' . $this->getRequest()->getParam('id')));
    			return;
    		}
    	}
    	 
    	Core::getBlock('application/admin/messenger')->addError($this->__('Не найдена запись для сохранения'));
    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
	}
}