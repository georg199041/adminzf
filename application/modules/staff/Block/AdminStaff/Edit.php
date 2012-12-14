<?php

class Staff_Block_AdminStaff_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		$this->getForm()->setName('form_data');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('text', 'name', array(
			'label'      => $this->__('Имя'),
			'required'   => true,
			'validators' => array(
				array('NotEmpty', true, array('messages' => array(
					Zend_Validate_NotEmpty::IS_EMPTY => $this->__('Это поле не может быть пустым')
				)))
			)
		));

		$this->addElement('textarea', 'description', array(
			'label' => $this->__('Описание'),
			'cols' => 70,
			'rows' => 15,
			'class' => 'mce',
		));

		$this->addElement('text', 'phone', array(
			'label' => $this->__('Телефон'),
		));

		$this->addElement('text', 'email', array(
			'label' => $this->__('Электронная почта'),
		));

		$this->addElement('text', 'skype', array(
			'label' => $this->__('Скайп'),
		));
		
		$this->addElement('text', 'image', array(
			'label' => $this->__('Картинка'),
		));
		$this->getElement('image')->setDecorators(array(
			array('CombinedElement', array('btns' => array('select' => array('label' => 'Выбрать'))))
		));
		
		$this->addElement('checkbox', 'enabled', array(
			'label'          => $this->__('Включено'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
		));
		
		$this->addDisplayGroup(array('name', 'description'), 'center');
		$this->addDisplayGroup(array('phone', 'email', 'skype', 'image', 'enabled'), 'right');
		
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
			Core::getBlock('staff/admin-staff/edit/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);
	}
}