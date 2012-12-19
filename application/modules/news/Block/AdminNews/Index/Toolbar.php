<?php

class News_Block_AdminNews_Index_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Список новостей'));
		
		$this->addButton(array(
			'name' 	 	 => 'show',
			'title' 	 => $this->__('Включить'),
			'urlOptions' => '*/*/enabled/value/YES',			
		));
		
		$this->addButton(array(
			'name' 		 => 'hide',
			'title' 	 => $this->__('Выключить'),
			'urlOptions' => '*/*/enabled/value/NO',			
		));
		
		$this->addButton(array(
			'name' 		 => 'move',
			'title' 	 => $this->__('Перемесить'),
			'urlOptions' => '*/*/move',			
		));
		
		$this->addButton(array(
			'name' => 'copy',
			'title' => $this->__('Копировать'),
			'urlOptions' => '*/*/copy',			
		));
		
		$this->addButton(array(
			'name' => 'delete',
			'title' => $this->__('Удалить'),
			'urlOptions' => '*/*/delete',			
		));
		
		$this->addButton(array(
			'name' => 'add',
			'title' => $this->__('Создать'),
			'urlOptions' => '*/*/edit',			
		));
	}
}