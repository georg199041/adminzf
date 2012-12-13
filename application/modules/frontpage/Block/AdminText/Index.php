<?php

class Frontpage_Block_AdminText_Index extends Core_Block_Grid_Widget
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
			'width' => '2',
			'align' => 'right',
		));
		
		$this->addColumn(array(
			'name'           => 'title',
			'type'           => 'hyperlink',
			'title'          => $this->__('Заголовок'),
			'th-align'       => 'left',
			'linkOptions'    => '*/*/edit',
			'linkBindFields' => array('id'),
		));
		
		$this->addColumn(array(
			'name'     => 'button_text',
			'title'    => $this->__('Заголовок кнопки'),
			'th-align' => 'left',
			'width'    => '2%',
			'nowrap'   => 'nowrap',
		));
		
		$this->addColumn(array(
			'name'              => 'enabled',
			'type'              => 'checkbox',
			'title'             => $this->__('Вкл'),
			'align'             => 'center',
			'checkedValue'      => 'YES',
			'uncheckedValue'    => 'NO',
			'width'             => '1%',
			'formactionOptions' => '*/*/enabled',
			'formactionBind'    => array('value' => 'enabled', 'ids' => 'id')
		));
		
		$this->setData(Core::getMapper('frontpage/text')->fetchAll());

		$this->addBlockChild(
			Core::getBlock('frontpage/admin-text/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'frontpage/admin-text/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('frontpage/text')->fetchCount(),
		), self::BLOCK_PLACEMENT_AFTER);
	}
}