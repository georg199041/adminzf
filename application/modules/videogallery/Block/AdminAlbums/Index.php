<?php

class Videogallery_Block_AdminAlbums_Index extends Core_Block_Grid_Widget
{
	public function init()
	{
		$this->setAttribute('width', '100%');
		$this->setAttribute('cellpadding', 0);
		$this->setAttribute('cellspacing', 0);
		
		$this->addColumn(array(
			'name' 	=> 'ids',
			'type'	=> 'checkbox',
			'title' => '<input type="checkbox" />',
			'width' => '1%',				
		));
		
		$this->addColumn(array(
			'name' 	=> 'id',
			'title' => $this->__('ID'),
			'width' => '50',
			'align' => 'right',				
		));
		
		$this->addColumn(array(
			'name' 			 => 'title',
			'type' 			 => 'hyperlink',
			'title' 		 => $this->__('Title'),
			'th-align' 		 => 'left',
			'linkOptions' 	 => '*/*/edit',
			'linkBindFields' => array('id'),						
		));
		
		$this->addColumn(array(
			'name' => 'enabled',
			'type' => 'checkbox',
			'title' => $this->__('On'),
			'checkedValue' => 'YES',
			'uncheckedValue' => 'NO',
			'width' => '1%',
			'formactionOptions' => '*/*/enabled',
			'formactionBind' => array('value' => 'enabled', 'ids' => 'id')								
		));
		
		$this->setData(Core::getMapper('videogallery/albums')->fetchAll());
		
		$this->addBlockChild(
			Core::getBlock('videogallery/admin-albums/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE		
		);
		
		$this->addBlockChild(array(
			'blockName' => 'videogallery/admin-albums/index/paggination',
			'totalItemsCount' => Core::getMapper('videogallery/albums')->fetchCount(),		
		), self::BLOCK_PLACEMENT_AFTER);
	}
}