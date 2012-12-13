<?php

class Photogallery_Model_Entity_Albums extends Core_Model_Entity_Abstract
{
	protected $_imageResizedToCrop178x120;
	
	public function setImageResizedToCrop178x120($image)
	{
		if ($cache = Zend_Registry::get('Zend_Cache_Manager')->getCache('resizeToCrop178x120')) {
			$this->_imageResizedToCrop178x120 = $cache->save($image);
		}
	
		return $this;
	}
	
	public function getImageResizedToCrop178x120()
	{
		if (null === $this->_imageResizedToCrop178x120) {
			if ($cache = Zend_Registry::get('Zend_Cache_Manager')->getCache('resizeToCrop178x120')) {
				if ($cache->test(parent::getImage())) {
					$this->_imageResizedToCrop178x120 = $cache->load(parent::getImage());
				} else {
					$this->_imageResizedToCrop178x120 = $cache->save(parent::getImage());
				}
			} else {
				$this->_imageResizedToCrop178x120 = false;
			}
		}
	
		return $this->_imageResizedToCrop178x120;
	}
	

	public function setImage($image)
	{
		parent::setImage($image);	
		$this->setImageResizedToCrop178x120($image);	
		return $this;
	}
	
	public function getImage()
	{
		$this->getImageResizedToCrop178x120();
		return parent::getImage();
	}
	
	public function getGridOrder()
	{
		$order = $this->getOrder();
		return $order ? $order : '-';
	}
}