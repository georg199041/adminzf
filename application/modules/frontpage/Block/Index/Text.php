<?php

class Frontpage_Block_Index_Text extends Core_Block_View
{
	protected $_text;
	public function getText()
	{
		if (null === $this->_text) {
			$this->_text = Core::getMapper('frontpage/text')->fetchRow();
			if (!$this->_text) {
				$this->_text = false;
			}
		}
	
		return $this->_text;
	}
}