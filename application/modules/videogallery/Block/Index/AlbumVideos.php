<?php

class Videogallery_Block_Index_AlbumVideos extends Core_Block_View
{
	/**
	 * 
	 * Set the cache in this block later
	 * 
	 * */
	public function init()
	{
		$this->headTitle($this->getAlbum()->getTitle());
	}
	
	protected $_album;
	public function getAlbum()
	{
		if (null === $this->_album){
			$this->_album = Core::getMapper('videogallery/albums')->fetchRow(array(
				'enabled = ?' => 'YES',
				'alias = ?'   => $this->getRequest()->getParam('album_alias')		
			));
			
			if (!$this->_album->getId()){
				throw new Exception('Page not found');
			}
		}

		return $this->_album;
	}
	
	protected $_albumVideos;
	public function getAlbumVideos()
	{
		if(null === $this->_albumVideos){
			$this->_albumVideos = Core::getMapper('photogallery/images')->fetchAll(array(
				'enabled = ?' => 'YES',
				'videogallery_albums_id = ?' => $this->getAlbum()->getId()		
			));
			
			if ($this->_albumPhotos->count() == 0){
				throw new Exception('Page not found');
			}
		}
		
		return $this->_albumVideos;
	}
	
}
