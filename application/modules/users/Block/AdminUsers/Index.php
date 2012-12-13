<?php

class Users_Block_AdminUsers_Index extends Core_Block_Grid_Widget
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
			'name'           => 'email',
			'type'           => 'hyperlink',
			'title'          => $this->__('Электронная почта'),
			'th-align'       => 'left',
			'linkOptions'    => '*/*/edit',
			'linkBindFields' => array('id'),
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

		$this->addColumn(array(
			'name'  => 'register_ts',
			'title' => $this->__('Дата регистрации'),
			'width' => '1%',
		));
		
		$this->setData(Core::getMapper('users/users')->fetchAll());

		$this->addBlockChild(
			Core::getBlock('users/admin-users/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'users/admin-users/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('users/users')->fetchCount(),
		), self::BLOCK_PLACEMENT_AFTER);
	}
}