<?php

class Photogallery_Block_Index_AlbumImages extends Core_Block_View
{
	/**
	 * Set use cahce in this block
	 * 
	 * @var boolean
	 */
	protected $_useCache = false;
	
	public function init()
	{
		$this->headTitle($this->getAlbum()->getTitle(), 'PREPEND');
	}
	
	public function getCacheId(Core_Block_View $block)
	{
		return parent::getCacheId($this) . '_' . $this->getAlbum()->getId();
	}
	
	protected $_album;
	public function getAlbum()
	{
		if (null === $this->_album) {
			$this->_album = Core::getMapper('photogallery/albums')->fetchRow(array(
				'enabled = ?' => 'YES',
				'alias = ?' => $this->getRequest()->getParam('album_alias')
			));
			
			if (!$this->_album->getId()) {
				throw new Exception('Page not found');
			}
		}
		
		return $this->_album;
	}
	
	protected $_albumPhotos;
	public function getAlbumPhotos()
	{
		if (null === $this->_albumPhotos) {
			$this->_albumPhotos = Core::getMapper('photogallery/images')->fetchAll(array(
				'enabled = ?' => 'YES',
				'photogallery_albums_id = ?' => $this->getAlbum()->getId()
			));
			
			if ($this->_albumPhotos->count() == 0) {
				throw new Exception('Page not found');
			}
		}
		
		return $this->_albumPhotos;
	}
}