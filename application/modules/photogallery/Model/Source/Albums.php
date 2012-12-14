<?php

class Photogallery_Model_Source_Albums extends Core_Model_Source_DbTable
{
	public function fetchAlbumsCovers()
	{
		$select = $this->createSelect();
		
		$sub = clone $select;
		$sub->reset();
		$sub->setIntegrityCheck(false);
		
		$sub->from('photogallery_images', 'image');
		$sub->where('`photogallery_albums`.`id` = `photogallery_images`.`photogallery_albums_id`');
		$sub->where('`photogallery_images`.`enabled` = ?', 'YES');
		$sub->order(array(
			'photogallery_images.cover ASC',
			'photogallery_images.created_ts DESC'
		));
		$sub->limit(1);
		
		$select->columns(array('image' => new Zend_Db_Expr('(' . $sub . ')')));
		$select->where('`photogallery_albums`.`enabled` = ?', 'YES');
		
		return $this->_fetch($select);
	}
}