<?php

class Users_Block_AdminUsers_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		$this->getForm()->setName('form_data');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('text', 'email', array(
			'label'      => $this->__('Электронная почта'),
			'required'   => true,
			'validators' => array(
				array('NotEmpty', true, array('messages' => array(
					Zend_Validate_NotEmpty::IS_EMPTY => $this->__('Это поле не может быть пустым')
				)))
			)
		));

		$this->addElement('password', 'password', array(
			'label'          => $this->__('Пароль'),
			//'renderPassword' => true,
		));

		$this->addElement('password', 'repeat_password', array(
			'label'          => $this->__('Повтор пароля'),
			//'renderPassword' => true,
		));
		
		$this->addElement('checkbox', 'enabled', array(
			'label'          => $this->__('Разрешен'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
		));
		
		$this->addDisplayGroup(array('email', 'password', 'repeat_password'), 'center');
		$this->addDisplayGroup(array('enabled'), 'right');
		
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
			Core::getBlock('users/admin-users/edit/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);
	}
	
	public function isValid($values)
	{
		$valid = $this->getForm()->isValid($values);
		if ($this->getElement('password')->getValue() != $this->getElement('repeat_password')->getValue()) {
			$this->getElement('repeat_password')->addError($this->__('Веденные пароли не совпадают'));
			$valid = false;
		}
		
		return $valid;
	}
}