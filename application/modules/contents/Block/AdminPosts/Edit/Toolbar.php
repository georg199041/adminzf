<?php

class Contents_Block_AdminPosts_Edit_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Редактирование постов контента'));
		
		$this->addButton(array(
			'name'  => 'save',
			'title' => $this->__('Сохранить'),
			'urlOptions' => '*/*/save/'
		));
		
		$this->addButton(array(
			'name'  => 'back',
			'title' => $this->__('Применить'),
			'urlOptions' => '*/*/save'
		));
		
		$this->addButton(array(
			'name'  => 'cancel',
			'title' => $this->__('Назад'),
			'urlOptions' => '*/*/index'
		));
	}
}