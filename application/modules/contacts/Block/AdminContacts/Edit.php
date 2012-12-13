<?php

class Contacts_Block_AdminContacts_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		$this->getForm()->setName('form_data');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('select', 'contacts_groups_id', array(
			'label'        => $this->__('Группа'),
			'required'     => true,
			'multiOptions' => $this->getContactsGroupsId(Core::getMapper('contacts/groups')->fetchAll()),
		));

		$this->addElement('select', 'type', array(
			'label'        => $this->__('Тип'),
			'required'     => true,
			'multiOptions' => array(
				'ADDRESS'   => $this->__('Адрес'),
				'MAINPHONE' => $this->__('Основной телефон'),
				'PHONE'     => $this->__('Телефон'),
				'EMAIL'     => $this->__('Электронная почта'),
				'SKYPE'     => $this->__('Скайп'),
				'LATLNG'    => $this->__('Координаты на карте'),
				'QRCODE'    => $this->__('QR код'),
				'IMAGE'     => $this->__('Картинка'),
				'LINK'      => $this->__('Ссылка'),
			),
		));

		$this->addElement('text', 'title', array(
			'label'    => $this->__('Заголовок'),
			'required' => true,
		));

		$this->addElement('text', 'alias', array(
			'label'    => $this->__('Псевдоним (УРЛ)'),
			'required' => true,
		));

		$this->addElement('textarea', 'description', array(
			'label' => $this->__('Описание/значение'),
			'cols' => 70,
			'rows' => 15,
			'class' => 'mce',
		));

		$this->addElement('text', 'image', array(
			'label' => $this->__('Картинка'),
		));
		$this->getElement('image')->setDecorators(array(
			array('CombinedElement', array('btns' => array('select' => array('label' => 'Выбрать'))))
		));
		
		$this->addElement('checkbox', 'enabled', array(
			'label'          => $this->__('Включен'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
		));
		
		$this->addDisplayGroup(array('title', 'alias', 'description'), 'center');
		$this->addDisplayGroup(array('contacts_groups_id', 'type', 'image', 'enabled'), 'right');
		
		if (isset(Core::getSession('admin')->formData)) {
			$this->setDefaults(Core::getSession('admin')->formData);
			unset(Core::getSession('admin')->formData);
		} else if (Zend_Registry::isRegistered('form_data')) {
			$this->setDefaults(Zend_Registry::get('form_data'));
		}

		if (isset(Core::getSession('admin')->formHasErrors) && Core::getSession('admin')->formHasErrors) {
			$this->isValid($this->getValues());
			unset(Core::getSession('admin')->formHasErrors);
		}
		
		$this->addBlockChild(
			Core::getBlock('contacts/admin-contacts/edit/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);
	}
	
	public function getContactsGroupsId($collection)
	{
		$result = array();
		foreach ($collection as $item) {
			$result[$item->getId()] = $item->getTitle();
		}
		
		return $result;
	}
}