<?php

class Navigation_Block_AdminPages_Index_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Управление страницами'));
		
		$this->addButton(array(
			'name'       => 'show',
			'title'      => $this->__('Включить'),
			'urlOptions' => '*/*/status/enabled/YES',
		));
		
		$this->addButton(array(
			'name'       => 'hide',
			'title'      => $this->__('Выключить'),
			'urlOptions' => '*/*/status/enabled/NO',
		));
		
		$this->addButton(array(
			'name'       => 'move',
			'title'      => $this->__('Переместить'),
			'urlOptions' => '*/*/move',
			'parent'     => 'navigation_pages_id'
		));
		
		$this->addButton(array(
			'name'       => 'copy',
			'title'      => $this->__('Копировать'),
			'urlOptions' => '*/*/copy',
			'parent'     => 'navigation_pages_id'
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