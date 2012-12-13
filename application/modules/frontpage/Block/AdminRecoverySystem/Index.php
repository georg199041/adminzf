<?php

class Frontpage_Block_AdminRecoverySystem_Index extends Core_Block_Grid_Widget
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
			'name'     => 'description',
			'title'    => $this->__('Описание'),
			'th-align' => 'left',
			'width'    => '50%',
		));
		
		$this->setData(Core::getMapper('frontpage/recovery-system')->fetchAll());

		$this->addBlockChild(
			Core::getBlock('frontpage/admin-recovery-system/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'frontpage/admin-recovery-system/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('frontpage/recovery-system')->fetchCount(),
		), self::BLOCK_PLACEMENT_AFTER);
	}
}