<?php

class Videogallery_Block_Index_Album extends Core_Block_View
{	
	protected $_album;
	public function getAlbum()
	{
		if (null === $this->_album) {
				$this->_album = Core::getMapper('videogallery/albums')->fetchRow(array(
				'enabled = ?' => 'YES',
				'alias = ?' => $this->getRequest()->getParam('album_alias', ''),
			)); 
			if (!$this->_album->getId()) {
				throw new Exception('Page not found');
			}
		}
		
		return $this->_album;
	}
}
