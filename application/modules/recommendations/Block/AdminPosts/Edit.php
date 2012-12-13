<?php

class Recommendations_Block_AdminPosts_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		$this->getForm()->setName('form_data');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('text', 'title', array(
			'label'      => $this->__('Заголовок'),
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

		$this->addElement('text', 'order', array(
			'label' => $this->__('Номер по порядку'),
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
			'decorator' => 'CombinedElement',
		));

		$this->addElement('textarea', 'meta_keywords', array(
			'label' => $this->__('META тег "keywords"'),
			'rows' => 2,
		));
		
		$this->addElement('textarea', 'meta_description', array(
			'label' => $this->__('META тег "description"'),
			'rows' => 7,
		));
		
		$this->addDisplayGroup(array('title', 'description'), 'center');
		$this->addDisplayGroup(array('order', 'image', 'enabled', 'meta_keywords', 'meta_description'), 'right');
		
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
			Core::getBlock('recommendations/admin-posts/edit/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);
	}
}