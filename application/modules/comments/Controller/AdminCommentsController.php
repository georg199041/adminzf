<?php

class Comments_AdminCommentsController extends Core_Controller_Action
{	
	public function init()
	{
		$this->getHelper('layout')->setLayout('admin');
		$this->view->headTitle('Комментарии');
	}
	
	public function indexAction(){}
    
    public function editAction()
    {
    	$id    = $this->getRequest()->getParam('id');
    	$model = Core::getMapper('comments/comments')->find($id);
    	
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
    			$form = Core::getBlock('сomments/admin-сomments/edit');
    			if (!$form->isValid($data)) {
    				Core::getSession('admin')->formHasErrors = true;
    				throw new Exception($this->__("Invalid form"));
    			}
    			
    			$model = Core::getMapper('comments/comments')->create($form->getValues());
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
    			Core::getBlock('application/admin/messenger')->addError($this->__('Ошибка сохранения'));
    			$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/edit/id/' . $this->getRequest()->getParam('id')));
    			return;
    		}
    	}
    	 
    	Core::getBlock('application/admin/messenger')->addError($this->__('Не найдена запись для сохранения'));
    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
    }
    
    public function deleteAction()
    {
        $ids = $this->getRequest()->getParam('ids');
        if (!is_array($ids) && null !== $ids) {
        	$ids = array($ids => 1);
        }
    	
    	if (null === $ids) {
    		Core::getBlock('application/admin/messenger')->addError($this->__('Не выбрана ни одна запись'));
    	} else {
    		try {
    			foreach ($ids as $id => $selected) {
    				$model = Core::getMapper('comments/comments')->find($id);
    				$model->delete();
    			}
    			 
    			Core::getBlock('application/admin/messenger')->addSuccess($this->__('Удалено записей:') . ' ' . count($ids));
    		} catch (Exception $e) {
    			Core::getBlock('application/admin/messenger')->addError($this->__('Ошибка удаления'));
    		}
    	}
    	 
    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
    }
    
    public function statusAction()
    {
        $ids = $this->getRequest()->getParam('ids');
        if (!is_array($ids) && null !== $ids) {
        	$ids = array($ids => 1);
        }
    	
    	if (null === $ids) {
    		Core::getBlock('application/admin/messenger')->addError($this->__('Не выбрана ни одна запись'));
    	} else {
    		try {
    			foreach ($ids as $id => $selected) {
    				if ($selected) {
	    				$model = Core::getMapper('comments/comments')->find($id);
	    				$model->setStatus($this->getRequest()->getParam('value'));
	    				$model->save();
    				}
    			}
    			
    			Core::getBlock('application/admin/messenger')->addSuccess($this->__('Изменено записей:') . ' ' . count($ids));
    		} catch (Exception $e) {
    			Core::getBlock('application/admin/messenger')->addError($this->__('Ошибка изменения статуса'));
    		}
    	}
    	
    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'), null, true);
    }
}
