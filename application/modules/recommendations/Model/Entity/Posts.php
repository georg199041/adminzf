<?php

class Recommendations_Model_Entity_Posts extends Core_Model_Entity_Abstract
{
	/*protected static $_imagesCache;
	
	public function setImagesCache(Zend_Cache_Core $cache)
	{
		self::$_imagesCache = $cache;
		return $this;
	}
	
	public function getImagesCache()
	{
		if (null === self::$_imagesCache && Zend_Registry::isRegistered('Zend_Cache_Manager')) {
			self::$_imagesCache = Zend_Registry::get('Zend_Cache_Manager')->getCache('Recomendations');
		}
		
		if (null === self::$_imagesCache) {
			self::$_imagesCache = false;
		}
		
		return self::$_imagesCache;
	}
	
	public function getBigImage()
	{
		if ($this->getImagesCache()) {
			$this->getImagesCache()->setMasterFiles(array(PUBLIC_PATH . $this->getImage()));
			$id = get_class($this) . '_' . $this->getId() . '_570';
			if (!$this->getImagesCache()->test($id)) {
				//echo 'NOTOK';
				// create file
				// save file
				// return path
				// TODO create slave file control backend
				$this->getImagesCache()->save(PUBLIC_PATH . $this->getImage(), $id);
			} else {
				//echo 'OK';
				// return path
				$this->getImagesCache()->load($id);
			}
		}
		
		return $this->getImage();
	}*/
}