<?php

class Contacts_IndexController extends Core_Controller_Action
{	
	public function init()
	{
		$this->getHelper('layout')->setLayout('google');
	}
	
	public function indexAction()
	{
		$form = Core::getBlock('contacts/index/feedback');
		if (($data = $this->getRequest()->getPost())) {
			try {
				if (!$form->isValid($data)) {
					if ($this->getRequest()->isXmlHttpRequest()) {
						$this->getHelper('Json')->sendJson(array(
							'errors' => $form->getMessages()
						));
						return;
					}
						
					Core::getSession('front')->formHasErrors = true;
					throw new Exception('Invalid form');
				}
		
				$model = Core::getMapper('contacts/feedback')->create($form->getValues());
				$model->save();
				unset(Core::getSession('front')->formData);
		
				if ($this->getRequest()->isXmlHttpRequest()) {
					$this->getHelper('Json')->sendJson(array(
						'success' => $this->__('Ваш сообщение отправлено')
					));
					return;
				}
		
				$form->reset();
			} catch (Exception $e) {
				if ($this->getRequest()->isXmlHttpRequest()) {
					$this->getHelper('Json')->sendJson(array(
						'error' => $this->__('Ошибка отправки')
					));
					return;
				}
		
				Core::getSession('front')->formData = $data;
			}
		}
		
		//if ($this->getRequest()->isXmlHttpRequest()) {
		//	$this->getHelper('Json')->sendJson(array(
		//			'error' => $this->__('contacts<!--request-->')
		//	));
		//	return;
		//}
		
		//$this->getHelper('Redirector')->gotoUrlAndExit($this->getRequest()->getParam('back_url'));
	}
}
