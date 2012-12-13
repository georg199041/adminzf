<?php

// TODO control of lifetime
class Default_AdminCacheController extends Core_Controller_Action
{
	public function init()
	{
		$this->getHelper('layout')->setLayout('admin');
		$this->view->headTitle('Управление кешем');
	}
	
	public function indexAction(){}
	
	public function enabledAction()
	{
		$ids = $this->getRequest()->getParam('ids');
		if (!is_array($ids) && null !== $ids) {
			$ids = array($ids => 1);
			$this->getRequest()->setParam('value', $this->getRequest()->getParam('value') == '1' ? '0' : '1');
		}
	
		if (null === $ids) {
			Core::getBlock('application/admin/messenger')->addError($this->__('Не выбрана ни одна запись'));
		} else {
			try {
				foreach ($ids as $id => $selected) {
					if ($selected) {
						$model = Core::getMapper('default/cache')->find($id);
						$model->setCaching($this->getRequest()->getParam('value'));
						$model->save();
					}
				}
				
				Core::getSession('admin')->optionsChanged = true;
				$message = $this->getRequest()->getParam('value') == '1' ? 'Включено' : 'Выключено';
				Core::getBlock('application/admin/messenger')->addSuccess($this->__($message . ' записей:') . ' ' . count($ids));
			} catch (Exception $e) {
				$message = $this->getRequest()->getParam('value') == '1' ? 'включения' : 'выключения';
				Core::getBlock('application/admin/messenger')->addError($this->__('Ошибка ' . $message));
			}
		}
		 
		$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'), null, true);
	}
	
	public function cleanAction()
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
						$model = Core::getMapper('default/cache')->find($id);
						$model->clean();
					}
				}
		
				Core::getBlock('application/admin/messenger')->addSuccess($this->__('Кеш записей очищен'));
			} catch (Exception $e) {
				Core::getBlock('application/admin/messenger')->addError($this->__('Ошибка очистки кеша'));
			}
		}
			
		$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'), null, true);
	}
}