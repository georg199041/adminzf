<?php

class Comments_Block_AdminComments_Index_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Комментарии'));
		
		$this->addButton(array(
			'name'       => 'setNotviewed',
			'title'      => $this->__('Не просмотрен'),
			'urlOptions' => '*/*/status/value/NOTVIEWED',
		));
		
		$this->addButton(array(
			'name'       => 'setModerated',
			'title'      => $this->__('Подтвержден'),
			'urlOptions' => '*/*/status/value/MODERATED',
		));
		
		$this->addButton(array(
			'name'       => 'setRegected',
			'title'      => $this->__('Отклонен'),
			'urlOptions' => '*/*/status/value/REJECTED',
		));
		
		$this->addButton(array(
			'name'       => 'delete',
			'title'      => $this->__('Удалить'),
			'urlOptions' => '*/*/delete',
		));
		
		$this->addButton(array(
			'name'       => 'add',
			'title'      => $this->__('Создать'),
			'urlOptions' => '*/*/edit',
		));
	}
}