<?php

class Navigation_Block_Index_SidebarMenu extends Core_Block_View
{
	public function getSidebarMenu()
	{
		$active = Zend_Registry::get('Zend_Navigation')->findOneByActive(true);
		
		while ($active instanceof Zend_Navigation_Page && $active->getParent()->getId() != 2) {
			$active = $active->getParent();
		}
		
		return $active;
	}
	
	public function forseActivePageUrl($href)
	{
		$page = Zend_Registry::get('Zend_Navigation')->findOneByHref($href);
		if ($page) {
			$page->setActive(true);
		}
		
		return $this;
	}
}