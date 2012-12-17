<?php

class Videogallery_AdminAlbumsController extends Core_Controller_Action
{
	public function init()
	{
		$this->getHelper('layout')->setLayout('admin');
		$this->view->headTitle('Альбомы видеогалереи');
	}
	
	public function indexAction(){}
	
	public function editAction()
	{
		$id = $this->getRequest()->getParam('id');
		$model = Core::getMapper('videogallery/albums')->find($id);
		
		if ($model->getId() || $id == 0) {
			Zend_Registry::set('form_data', $model);
			return;
		}
		
		Core::getBlock('application/admin/messenger')->addError($this->__('Запись не найдена'));
		$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
	}
	
	public function saveAction()
	{
		if (($data = $this->getRequest()->getpost()) && !$this->getRequest()->getParam('cancel')) {
			try {
				$form = Core::getBlock('videogallery/admin-albums/edit');
				if (!$form->isValid($data)) {
					Core::getSession('admin')->formHasErrors = true;
					throw new Exception($this->__('Invalid form'));
				}
				
				$model = Core::getmapper('videogallery/albums')->create($form->getValues());
				$model->save();
				unset(Core::getSession('admin')->formData);
				
				Core::getBlock('application/admin/messenger')->addSuccess($this->__('Запись сохранена'));
				if ($this->getRequest()->getParam('back')) {
					$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/edit/id' . $model->getId()));
				}
				
				$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlTooptions('*/*/index'));
				return;
			} catch (Exception $e) {
				Core::getSession('admin')->formData = $data;
				Core::getBlock('application/admin/messenger')->addError($this->__('Ошибка сохранения'));
				$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/edit/id/' . $this-getRequest()->getparam('id')));
				return;
			}
		}
		
		Core::getBlock('application/admin/messenger')->addError($this->__('Не найдена запись для сохранения'));
		$this->gethelper('Redirector')->gotoRouteAndExit(Core::urlTooptions('*/*/index'));
	}
	
	public function deleteAction()
	{
		$ids = $this->getRequest()->getparam('ids');
		if (!is_array($ids)) {
			Core::getBlock('application/admin/messenger')->addError($this->__('Не выбрана ни одна запись'));
		} else {
			try {
				foreach ($ids as $id => $selected) {
					$model = Core::getmapper('videogallery/albums')->find($id);
					$model->delete();
				}
				
				Core::getBlock('application/admin/messenger')->addSuccess($this->__('Удалено записей:') . ' ' . count($ids));
			} catch (Exception $e) {
				Core::getBlock('application/admin/messenger')->addError($this->__('Ошибка удаления'));
			}
		}
		
		$this->gethelper('Redirector')->gotoRouteAndExit(Core::urlTooptions('*/*/index'));
	}
	
	public function enabledAction(){}
	
}