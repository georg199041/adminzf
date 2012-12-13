<?php

class Photogallery_AdminAlbumsController extends Core_Controller_Action
{	
	public function init()
	{
		$this->getHelper('layout')->setLayout('admin');
		$this->view->headTitle('Альбомы фотогалереи');
	}
	
	public function indexAction(){}
    
    public function editAction()
    {
    	$id    = $this->getRequest()->getParam('id');
    	$model = Core::getMapper('photogallery/albums')->find($id);
    	
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
    			$form = Core::getBlock('photogallery/admin-albums/edit');
    			if (!$form->isValid($data)) {
    				Core::getSession('admin')->formHasErrors = true;
    				throw new Exception($this->__("Invalid form"));
    			}
    			
    			$model = Core::getMapper('photogallery/albums')->create($form->getValues());
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
    	if (!is_array($ids)) {
    		Core::getBlock('application/admin/messenger')->addError($this->__('Не выбрана ни одна запись'));
    	} else {
    		try {
    			foreach ($ids as $id => $selected) {
    				$model = Core::getMapper('photogallery/albums')->find($id);
    				$model->delete();
    			}
    			 
    			Core::getBlock('application/admin/messenger')->addSuccess($this->__('Удалено записей:') . ' ' . count($ids));
    		} catch (Exception $e) {
    			Core::getBlock('application/admin/messenger')->addError($this->__('Ошибка удаления'));
    		}
    	}
    	 
    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
    }
    
    public function enabledAction()
    {
        $ids = $this->getRequest()->getParam('ids');
        if (!is_array($ids) && null !== $ids) {
        	$ids = array($ids => 1);
        	$this->getRequest()->setParam('value', $this->getRequest()->getParam('value') == 'YES' ? 'NO' : 'YES');
        }
        
        if (null === $ids) {
    		Core::getBlock('application/admin/messenger')->addError($this->__('Не выбрана ни одна запись'));
    	} else {
    		try {
    			foreach ($ids as $id => $selected) {
    				if ($selected) {
	    				$model = Core::getMapper('photogallery/albums')->find($id);
	    				$model->setEnabled($this->getRequest()->getParam('value'));
	    				$model->save();
    				}
    			}
    			
    			$message = $this->getRequest()->getParam('value') == 'YES' ? 'Включено' : 'Выключено';
    			Core::getBlock('application/admin/messenger')->addSuccess($this->__($message . ' записей:') . ' ' . count($ids));
    		} catch (Exception $e) {
    			$message = $this->getRequest()->getParam('value') == 'YES' ? 'включения' : 'выключения';
    			Core::getBlock('application/admin/messenger')->addError($this->__('Ошибка ' . $message));
    		}
    	}
    	
    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'), null, true);
    }
    
    public function moveAction()
    {
    	$ids = $this->getRequest()->getParam('ids');
    	if (!is_array($ids)) {
    		Core::getBlock('application/admin/messenger')->addError($this->__('Не выбрана ни одна запись'));
    	} else {
    		try {
    			foreach ($ids as $id => $selected) {
    				$model = Core::getMapper('photogallery/albums')->find($id);
   					$model->setContactsGroupsId($this->getRequest()->getParam('photogallery_albums_id'));
   					$model->save();
    			}
				
    			Core::getBlock('application/admin/messenger')->addSuccess($this->__('Перемещено записей:') . ' ' . count($ids));
    		} catch (Exception $e) {
    			Core::getBlock('application/admin/messenger')->addError($this->__('Ошибка перемещения'));
    		}
    	}
    	
    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'), null, true);
    }
    
    public function copyAction()
    {
    	$ids = $this->getRequest()->getParam('ids');
    	if (!is_array($ids)) {
    		Core::getBlock('application/admin/messenger')->addError($this->__('Не выбрана ни одна запись'));
    	} else {
    		try {
    			foreach ($ids as $id => $selected) {
    				$model = Core::getMapper('photogallery/albums')->find($id);
    				$model->setId(null);
   					$model->setContactsGroupsId($this->getRequest()->getParam('photogallery_albums_id'));
   					$model->save();
    			}
				
    			Core::getBlock('application/admin/messenger')->addSuccess($this->__('Скопировано записей:') . ' ' . count($ids));
    		} catch (Exception $e) {
    			Core::getBlock('application/admin/messenger')->addError($this->__('Ошибка копирования'));
    		}
    	}
    	
    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'), null, true);
    }
}
