<?php

class Contacts_AdminFeedbackController extends Core_Controller_Action
{	
	public function init()
	{
		$this->getHelper('layout')->setLayout('admin');
		$this->view->headTitle('Обратная связь');
	}
	
	public function indexAction(){}
    
    public function answerAction()
    {
    	$id    = $this->getRequest()->getParam('id');
    	$model = Core::getMapper('contacts/feedback')->find($id);
    	
    	if ($model->getId() || $id == 0) {
    		Zend_Registry::set('form_data', $model);
    		return;
    	}
    	
    	Core::getBlock('application/admin/messenger')->addError($this->__('Запись не найдена'));
    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
    }

    public function sendAction()
    {
    	if (($data = $this->getRequest()->getPost()) && !$this->getRequest()->getParam('cancel')) {
    		try {
    			$form = Core::getBlock('contacts/admin-feedback/answer');
    			if (!$form->isValid($data)) {
    				Core::getSession('admin')->formHasErrors = true;
    				throw new Exception($this->__("Invalid form"));
    			}
    			
    			$model = Core::getMapper('contacts/feedback')->create($form->getValues());
    			
    			$headers  = 'MIME-Version: 1.0' . "\r\n";
		    	$headers .= 'Content-type: text/html; utf-8' . "\r\n";
		        $headers .= 'From: ' . $model->getAnswerFrom() . ' ' . "\r\n";
		        
    			if (!@mail($model->getEmail(), $model->getAnswerSubject(), $model->getAnswerMessage(), $headers)) {
    				Core::getSession('admin')->formHasErrors = true;
    				throw new Exception($this->__("Invalid mail"));
    			}
    			
    			$model->save();
    			unset(Core::getSession('admin')->formData);
    	   
    			Core::getBlock('application/admin/messenger')->addSuccess($this->__('Сообщение отправлено'));
    			$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
    			return;
    		} catch (Exception $e) {
    			Core::getSession('admin')->formData = $data;
    			$message = $e->getMessage() == "Invalid mail" ? $this->__('Ошибка отправки сообщения') : $this->__('Ошибка');
    			Core::getBlock('application/admin/messenger')->addError($message);
    			$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/answer/id/' . $this->getRequest()->getParam('id')));
    			return;
    		}
    	}
    	 
    	Core::getBlock('application/admin/messenger')->addError($this->__('Не найдена запись'));
    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
    }
    
    public function deleteAction()
    {
    	$ids = $this->getRequest()->getParam('ids');
    	if (null === $ids) {
    		Core::getBlock('application/admin/messenger')->addError($this->__('Не выбрана ни одна запись'));
    	} else {
    		try {
    			foreach ($ids as $id) {
    				$model = Core::getMapper('contacts/feedback')->find($id);
    				$model->delete();
    			}
    			 
    			Core::getBlock('application/admin/messenger')->addSuccess($this->__('Удалено записей:') . ' ' . count($ids));
    		} catch (Exception $e) {
    			Core::getBlock('application/admin/messenger')->addError($this->__('Ошибка удаления'));
    		}
    	}
    	 
    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
    }
}
