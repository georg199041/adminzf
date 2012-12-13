<?php

class Photogallery_Model_Mapper_Albums extends Core_Model_Mapper_Abstract
{
	public function fetchAlbumsCovers()
	{
		$collection = $this->createCollection();		
		$this->_beforeFetchRows($collection);
		
		$rowset = $this->getSource()->fetchAlbumsCovers();
		foreach ($rowset as $row) {
			$collection->push($this->create($row));
		}
		
		$this->_afterFetchRows($collection);		
		return $collection;
	}
}