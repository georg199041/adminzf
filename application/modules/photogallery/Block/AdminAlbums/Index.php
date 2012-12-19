<?php

class Photogallery_Block_AdminAlbums_Index extends Core_Block_Grid_Widget
{
	public function init()
	{
		$this->setAttribute('width', '100%');		
		$this->setAttribute('cellpadding', 0);		
		$this->setAttribute('cellspacing', 0);
		
		$this->addColumn(array(
			'name'  => 'ids',
			'type'  => 'checkbox',
			'title' => '<input type="checkbox" />',
			'width' => '1%',
		));
		
		$this->addColumn(array(
			'name'  => 'id',
			'title' => $this->__('ID'),
			'width' => '50',
			'align' => 'right',
		));
		
		$this->addColumn(array(
			'name'           => 'title',
			'type'           => 'hyperlink',
			'title'          => $this->__('Title'),
			'th-align'       => 'left',
			'linkOptions'    => '*/*/edit',
			'linkBindFields' => array('id'),
		));
		
		$this->addColumn(array(
			'name'           	=> 'enabled',
			'type'           	=> 'checkbox',
			'title'          	=> $this->__('On'),
			'checkedValue'   	=> 'YES',
			'uncheckedValue' 	=> 'NO',
			'width'          	=> '1%',
			'formactionOptions' => '*/*/enabled',
			'formactionBind'    => array('value' => 'enabled', 'ids' => 'id')
		));
		
		$this->setData(Core::getMapper('photogallery/albums')->fetchAll());

		$this->addBlockChild(
			Core::getBlock('photogallery/admin-albums/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'photogallery/admin-albums/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('photogallery/albums')->fetchCount(),
		), self::BLOCK_PLACEMENT_AFTER);
	}
}