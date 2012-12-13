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
				'meta_keywords'    => $item->getMetaKeywords(),
				'meta_description' => $item->getMetaDescription(),
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
	
	public function setHeadMeta($container)
	{
		$page = $container->findOneByActive(true);
		if ($page) {
			if ($page->get('meta_keywords')) {
				Core::getBlock('application/default')->headMeta()->setName('keywords', $page->get('meta_keywords'));
			}
			if ($page->get('meta_description')) {
				Core::getBlock('application/default')->headMeta()->setName('description', $page->get('meta_description'));
			}
		}
	}
	
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		if (false === $this->_loaded) {
			$container = Zend_Registry::get('Zend_Navigation')->findOneById('frontend');
			$collection = Core::getMapper('navigation/pages')->fetchTree();
			$container->addPages($this->_buildNavigation($collection));
			$this->setHeadMeta($container);
			$this->_loaded = true;
		}		
	}
}