<?php

class Videogallery_Model_Source_Albums extends Core_Model_Source_DbTable
{
	public function fetchAlbumCovers()
	{
		$select = $this->createSelect();
		
		$sub = clone $select;
		$sub->reset();
		$sub->setIntegrityCheck(false);
		
		$sub->from('videogallery_videos', 'video');
		$sub->where('`videogallery_albums`.`id` = `videogallery_videos`.`videogallery_albums_id`');
		$sub->order(array(
			'videogallery_videos.cover ASC',
			'videogallery_videos.created_ts DESC'		
		));
		$sub->limit(1);
		
		$select->columns(array('image' => new Zend_Db_Expr('(' . $sub . ')')));
		$select->where('`videogallery_albums`.`enabled` = ?', 'YES');
		
		return $this->_fetch($select);
	}
}