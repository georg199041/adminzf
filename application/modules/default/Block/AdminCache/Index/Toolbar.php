<?php

class Default_Block_AdminCache_Index_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Управление кешем'));
		
		$this->addButton(array(
			'name'       => 'show',
			'title'      => $this->__('Включить'),
			'urlOptions' => '*/*/enabled/value/1',
			'class'      => 'btn btn-info multi-action',
		));
		
		$this->addButton(array(
			'name'       => 'hide',
			'title'      => $this->__('Выключить'),
			'urlOptions' => '*/*/enabled/value/0',
			'class'      => 'btn btn-info multi-action',
			'selector'   => '123'
		));
		
		$this->addButton(array(
			'name'       => 'clean',
			'title'      => $this->__('Очистить'),
			'urlOptions' => '*/*/clean',
			'class'      => 'btn multi-action',
		));
	}
}