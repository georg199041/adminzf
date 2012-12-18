<?php

class Videogallery_Block_AdminVideos_Index_toolbar extends Core_Block_Toolbar_widget
{
	public function init()
	{
		$this->setTitle($this->__('Видеозаписи видеогалереи'));
		
		$this->addButton(array(
			'name' 		 => 'show',
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
			'title' 	 => $this->__('Переместить'),
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