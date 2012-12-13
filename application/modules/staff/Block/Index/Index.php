<?php

class Staff_Block_Index_Index extends Core_Block_View
{
	protected $_staff;
	public function getStaff()
	{
		if (null === $this->_staff) {
			$this->_staff = Core::getMapper('staff/staff')->fetchAll(array(
				'enabled = ?' => 'YES',
			), 'order');
			
			if ($this->_staff->count() == 0) {
				throw new Exception('Page not found');
			}
		}
		
		return $this->_staff;
	}
}