<?php

class Users_Block_AdminUsers_Login extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/login');
		$this->getForm()->setName('form_data');
		
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
			'label' => $this->__('Пароль'),
			'required'   => true,
			'validators' => array(
				array('NotEmpty', true, array('messages' => array(
					Zend_Validate_NotEmpty::IS_EMPTY => $this->__('Это поле не может быть пустым')
				)))
			)
		));
		$this->getElement('password')->setDecorators(array(
			array('CombinedElement', array('btns' => array('select' => array('label' => 'Войти', 'type' => 'submit'))))
		));
		
		$this->addDisplayGroup(array('email', 'password'), 'login');
		
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
	}
	
	public function isValid($values)
	{
		$valid = $this->getForm()->isValid($values);
		if ($valid) {
			$model = Core::getMapper('users/users')->create($this->getValues());
			if (true !== ($result = Core::getMapper('users/users')->authenticate($model))) {
				$this->getElement('password')->addErrors($result->getMessages());
				$valid = false;
			}
		}
		
		return $valid;
	}
}