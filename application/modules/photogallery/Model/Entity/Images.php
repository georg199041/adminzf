<?php

class Photogallery_Model_Entity_Images extends Core_Model_Entity_Abstract
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
	
	protected $_imageResizedToCrop104x70;
	
	public function setImageResizedToCrop104x70($image)
	{
		if ($cache = Zend_Registry::get('Zend_Cache_Manager')->getCache('resizeToCrop104x70')) {
			$this->_imageResizedToCrop104x70 = $cache->save($image);
		}
		
		return $this;
	}
	
	public function getImageResizedToCrop104x70()
	{
		if (null === $this->_imageResizedToCrop104x70) {
			if ($cache = Zend_Registry::get('Zend_Cache_Manager')->getCache('resizeToCrop104x70')) {
				if ($cache->test(parent::getImage())) {
					$this->_imageResizedToCrop104x70 = $cache->load(parent::getImage());
				} else {
					$this->_imageResizedToCrop104x70 = $cache->save(parent::getImage());
				}
			} else {
				$this->_imageResizedToCrop104x70 = false;
			}
		}
		
		return $this->_imageResizedToCrop104x70;
	}

	protected $_imageResizedToWidth570;
	
	public function setImageResizedToWidth570($image)
	{
		if ($cache = Zend_Registry::get('Zend_Cache_Manager')->getCache('resizeToCrop104x70')) {
			$this->_imageResizedToWidth570 = $cache->save($image);
		}
	
		return $this;
	}
	
	public function getImageResizedToWidth570()
	{
		if (null === $this->_imageResizedToWidth570) {
			if ($cache = Zend_Registry::get('Zend_Cache_Manager')->getCache('resizeToWidth570')) {
				if ($cache->test(parent::getImage())) {
					$this->_imageResizedToWidth570 = $cache->load(parent::getImage());
				} else {
					$this->_imageResizedToWidth570 = $cache->save(parent::getImage());
				}
			} else {
				$this->_imageResizedToWidth570 = false;
			}
		}
	
		return $this->_imageResizedToWidth570;
	}
	
	public function setImage($image)
	{
		//$this->_data['image'] = $image;
		parent::setImage($image);
		
		$this->setImageResizedToCrop178x120($image);
		$this->setImageResizedToCrop104x70($image);
		$this->setImageResizedToWidth570($image);
		
		return $this;
	}
	
	public function getImage()
	{
		$this->getImageResizedToCrop178x120();
		$this->getImageResizedToCrop104x70();
		$this->getImageResizedToWidth570();
		
		return parent::getImage();
	}
}