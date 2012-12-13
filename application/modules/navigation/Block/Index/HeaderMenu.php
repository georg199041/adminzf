<?php

class Navigation_Block_Index_HeaderMenu extends Core_Block_View
{
	public function getHeaderMenu()
	{
		return Zend_Registry::get('Zend_Navigation')->findOneById('2');
	}
	
	public function isActive($page)
	{
		if ($page instanceof Zend_Navigation_Page) {
			if ($page->isActive()) {
				$this->headTitle($page->getLabel());
				return true;
			}
			
			foreach ($page as $item) {
				if ($this->isActive($item)) {
					return true;
				}
			}
		}
		
		return false;
	}
}