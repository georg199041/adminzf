<?php

class Frontpage_Block_Index_Slider extends Core_Block_View
{
	protected $_slides;
	public function getSlides()
	{
		if (null === $this->_slides) {
			$this->_slides = Core::getMapper('frontpage/slider')->fetchAll();
		}
		
		return $this->_slides;
	}
}