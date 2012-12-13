<?php

class Contacts_Block_Index_Index extends Core_Block_View
{
	protected $_contacts;
	public function getContacts()
	{
		if (null === $this->_contacts) {
			$contacts = Core::getMapper('contacts/groups')->fetchAll(array(
				'enabled = ?' => 'YES'
			));
			
			foreach ($contacts as $item) {
				$contacts = Core::getMapper('contacts/contacts')->fetchAll(array(
					'contacts_groups_id = ?' => $item->getId(),
					'enabled = ?' => 'YES',
				));
				
				$phones = Core::getMapper('contacts/contacts')->createCollection();
				foreach ($contacts as $contact) {
					switch ($contact->getType()) {
						case 'PHONE':
							$phones->push($contact);
							break;
						default:
							$item->{'setContact' . ucfirst(strtolower($contact->getType()))}($contact);
							break;
					}
				}
				
				$item->setContactPhones($phones);				
				$this->_contacts[$item->getAlias()] = $item;
			};
		}
		
		return $this->_contacts;
	}
	
	public function getCrimeaBaseContacts()
	{
		$this->getContacts();
		return $this->_contacts['crimea_base'];
	}
	
	public function getMoscowOfficeContacts()
	{
		$this->getContacts();
		return $this->_contacts['moscow_office'];
	}
}