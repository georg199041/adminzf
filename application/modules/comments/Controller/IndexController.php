<?php

class Comments_IndexController extends Core_Controller_Action
{	
	public function init()
	{
		$this->view->headTitle('Comments');
	}
	
	public function indexAction(){}
	
	public function commentsAction(){}
	
	public function addCommentAction()
	{
		$form = Core::getBlock('comments/index/add-comment');
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
				
				$model = Core::getMapper('comments/comments')->create($form->getValues());
				$model->setCreatedTs(time());
				$model->setStatus('MODERATED');
				$model->setIp($_SERVER['REMOTE_ADDR']);
				$model->setUserAgent($_SERVER['HTTP_USER_AGENT']);
				$model->save();
				unset(Core::getSession('front')->formData);
				
				if ($this->getRequest()->isXmlHttpRequest()) {
					$this->getHelper('Json')->sendJson(array(
						'success' => $this->__('Ваш комментарий добавлен')
					));
					return;
				}
				
				$form->reset();
			} catch (Exception $e) {
				if ($this->getRequest()->isXmlHttpRequest()) {
					$this->getHelper('Json')->sendJson(array(
						'error' => $this->__('Ошибка добавления комментария' . $e->getMessage())
					));
					return;
				}
				
				Core::getSession('front')->formData = $data;
			}
		}
		
		if ($this->getRequest()->isXmlHttpRequest()) {
			$this->getHelper('Json')->sendJson(array(
				'error' => $this->__('Ошибка передачи данных')
			));
			return;
		}
		
		$this->getHelper('Redirector')->gotoUrlAndExit($this->getRequest()->getParam('back_url'));
	}
}
