<?php

class Contacts_Block_AdminFeedback_Answer_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Обратная связь (ответ)'));
		
		$this->addButton(array(
			'type'  => 'submit',
			'name'  => 'back',
			'title' => $this->__('Отправить'),
			'urlOptions' => '*/*/send'
		));
		
		$this->addButton(array(
			'name'  => 'cancel',
			'title' => $this->__('Назад'),
			'urlOptions' => '*/*/index'
		));
	}
}