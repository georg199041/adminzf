<?php

class Photogallery_Block_Index_Album extends Core_Block_View
{
	public function getAlbum()
	{
		try {
			return Core::getBlock('photogallery/index/album-images')->getAlbum();
		} catch (Exception $e) {
			
		}
	}
}