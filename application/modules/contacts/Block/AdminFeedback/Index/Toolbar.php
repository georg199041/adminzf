<?php

class Contacts_Block_AdminFeedback_Index_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Обратная связь'));
		
		$this->addButton(array(
			'name'       => 'delete',
			'title'      => $this->__('Удалить'),
			'urlOptions' => '*/*/delete',
		));
	}
}