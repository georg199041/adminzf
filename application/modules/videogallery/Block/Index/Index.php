<?php

class Videogallery_Block_Index_Index extends Core_Block_View
{
	protected $_albums;
	public function getAlbums()
	{
		if (null === $this->_albums) {
			$this->_albums = Core::getMapper('videogallery/albums')->fetchAlbumsCovers();
			if ($this->_albums->count() == 0) {
				throw new Exception('Page not found');
			}
		}
		
		return $this->_albums;
	}
}
