<?php

class Videogallery_Block_Index_Album extends Core_Block_View
{
	public function getAlbum()
	{
		try{
			return Core::getBlock('videogallery/index/album-images')->getAbum(); 
		} catch (Exception $e){
			
		}
	}
}
