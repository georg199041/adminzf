<?php

class Videogallery_Block_AdminVideos_Edit_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Редактирование видео'));
		
		$this->addButton(array(
			'type' => 'submit',
			'name' => 'save',
			'title' => $this->__('Сохранить'),	
			'urloptions' => '*/*/save',			
		));
		
		$this->addButton(array(
			'type' => 'submit',
			'name' => 'back',
			'title' => $this->__('Применить'),
			'urlOptions' => '*/*/save',				
		));
		
		$this->addButton(array(
			'name' => 'cancel',
			'title' => $this->__('Назад'),
			'urlOptions' => '*/*/index'			
		));
	}
}