<?php

class Application_Block_Default_Header extends Core_Block_View
{
	protected $_crimeaBaseMainPhone;
	public function getCrimeaBaseMainPhone()
	{
		if (null === $this->_crimeaBaseMainPhone) {
			$this->_crimeaBaseMainPhone = Core::getMapper('contacts/contacts')->fetchRow(array(
				'alias = ?'   => 'crimea_main_phone',
				'enabled = ?' => 'YES',
				'type'        => 'PHONE'
			));
		}
		
		return $this->_crimeaBaseMainPhone;
	}
	
	protected $_moscowOfficeMainPhone;
	public function getMoscowOfficeMainPhone()
	{
		if (null === $this->_moscowOfficeMainPhone) {
			$this->_moscowOfficeMainPhone = Core::getMapper('contacts/contacts')->fetchRow(array(
				'alias = ?'   => 'moscow_main_phone',
				'enabled = ?' => 'YES',
				'type'        => 'PHONE'
			));
		}
		
		return $this->_moscowOfficeMainPhone;
	}
	
	protected $_moscowOfficeAddress;
	public function getMoscowOfficeAddress()
	{
		if (null === $this->_moscowOfficeAddress) {
			$this->_moscowOfficeAddress = Core::getMapper('contacts/contacts')->fetchRow(array(
				'alias = ?'   => 'moscow_address',
				'enabled = ?' => 'YES',
				'type'        => 'ADDRESS'
			));
		}
		
		return $this->_moscowOfficeAddress;
	}
}