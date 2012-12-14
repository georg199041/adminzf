<?php

class Navigation_Controller_Plugin_Navigation extends Zend_Controller_Plugin_Abstract
{
	protected $_loaded = false;
	
	protected function _buildNavigation($collection)
	{
		$pages = array();
		
		foreach ($collection as $item) {
			$page = array(
				'id'           => $item->getId(),
				'label'        => $item->getLabel(),
				'type'         => $item->getType(),
				'uri'          => $item->getUri(),
				'module'       => $item->getModule(),
				'controller'   => $item->getController(),
				'action'       => $item->getAction(),
				'params'       => $item->getParams() ? json_decode($item->getParams(), true) : null,
				'route'        => $item->getRoute() ? $item->getRoute() : 'default',
				'reset_params' => $item->getResetParams() == 'YES' ? true : false,
				'encode_url'   => $item->getEncodeUrl() == 'YES' ? true : false,
				'order'        => $item->getOrder(),
			);
			
			if ($item->getType() == 'URI' && $item->getUri() == $_SERVER['REQUEST_URI']) {
				$page['active'] = true;
			}
			
			if (count($item->getChilds())) {
				$page['pages'] = $this->_buildNavigation($item->getChilds());
			}
			
			$pages[(string) $item->getId()] = $page;
		}
		
		return $pages;
	}
	
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		if (false === $this->_loaded) {
			$container = Zend_Registry::get('Zend_Navigation')->findOneById('frontend');
			$collection = Core::getMapper('navigation/pages')->fetchTree();
			$container->addPages($this->_buildNavigation($collection));
			$this->_loaded = true;
		}		
	}
}