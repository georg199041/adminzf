<?php

class Frontpage_Block_Index_RecoverySystem extends Core_Block_View
{
	protected $_recoverySystemItems;
	public function getRecoverySystemItems()
	{
		if (null === $this->_recoverySystemItems) {
			$this->_recoverySystemItems = Core::getMapper('frontpage/recovery-system')->fetchAll();
		}
		
		return $this->_recoverySystemItems;
	}
}