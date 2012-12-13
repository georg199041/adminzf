<?php

class Contacts_Block_AdminFeedback_Answer extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/send');
		$this->getForm()->setName('form_data');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('text', 'name', array(
			'label'    => $this->__('Имя отправителя'),
			'readonly' => true,
		));
		
		$this->addElement('text', 'email', array(
			'label'    => $this->__('Адрес отправителя'),
			'readonly' => true,
		));
		
		$this->addElement('textarea', 'message', array(
			'label'    => $this->__('Сообщение'),
			'readonly' => true,
			'rows'     => 15,
		));
		
		$this->addElement('text', 'answer_from', array(
			'label'    => $this->__('Адрес отвечающего'),
			'required' => true,
			'validators' => array(
				array('NotEmpty', true, array('messages' => array(
					Zend_Validate_NotEmpty::IS_EMPTY => $this->__('Это поле не может быть пустым')
				))),
				array('EmailAddress', true, array('messages' => array(
					Zend_Validate_EmailAddress::INVALID            => $this->__('Неправильный Email адреса'),
					Zend_Validate_EmailAddress::INVALID_FORMAT     => $this->__('Неправильный формат Email адреса'),
					Zend_Validate_EmailAddress::INVALID_HOSTNAME   => $this->__('Неправильный хост Email адреса'),
					Zend_Validate_EmailAddress::INVALID_MX_RECORD  => $this->__('Неправильный MX Email адреса'),
					Zend_Validate_EmailAddress::INVALID_SEGMENT    => $this->__('Неправильный сегмент Email адреса'),
					Zend_Validate_EmailAddress::DOT_ATOM           => $this->__('Неправильный Atom'),
					Zend_Validate_EmailAddress::QUOTED_STRING      => $this->__('Неверно экранированая строка'),
					Zend_Validate_EmailAddress::INVALID_LOCAL_PART => $this->__('Неправильная локальная часть Email адреса'),
					Zend_Validate_EmailAddress::LENGTH_EXCEEDED    => $this->__('Слишком длинный Email адрес'),
				))),
			)
		));
		
		$this->addElement('text', 'answer_subject', array(
			'label'    => $this->__('Тема ответа'),
			'required' => true,
			'validators' => array(
				array('NotEmpty', true, array('messages' => array(
					Zend_Validate_NotEmpty::IS_EMPTY => $this->__('Это поле не может быть пустым')
				)))
			)
		));
		
		$this->addElement('textarea', 'answer_message', array(
			'label'    => $this->__('Текст ответа'),
			'required' => true,
			'cols'     => 70,
			'rows'     => 15,
			'class'    => 'mce',
			'validators' => array(
				array('NotEmpty', true, array('messages' => array(
					Zend_Validate_NotEmpty::IS_EMPTY => $this->__('Это поле не может быть пустым')
				)))
			)
		));
		
		$this->addDisplayGroup(array('answer_from', 'answer_subject', 'answer_message'), 'center');
		$this->addDisplayGroup(array('name', 'email', 'message'), 'right');
		
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
			Core::getBlock('contacts/admin-feedback/answer/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);
	}
}