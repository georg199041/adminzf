<?php

class Frontpage_Block_AdminText_Index_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Текст на главной'));
		
		$this->addButton(array(
			'name'       => 'show',
			'title'      => $this->__('Включить'),
			'urlOptions' => '*/*/enabled/value/YES',
		));
		
		$this->addButton(array(
			'name'       => 'hide',
			'title'      => $this->__('Выключить'),
			'urlOptions' => '*/*/enabled/value/NO',
		));
	}
}