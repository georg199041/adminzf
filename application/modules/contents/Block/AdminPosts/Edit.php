<?php

class Contents_Block_AdminPosts_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		$this->getForm()->setName('form_data');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('text', 'title', array(
			'label'    => $this->__('Заголовок'),
			'required' => true,
		));
		
		$this->addElement('text', 'alias', array(
			'label'    => $this->__('Псевдоним'),
			'required' => true,
		));
		
		$this->addElement('textarea', 'introtext', array(
			'label' => $this->__('Краткое описание'),
			'cols' => 70,
			'rows' => 15,
			'class' => 'mce',
		));
		
		$this->addElement('textarea', 'fulltext', array(
			'label' => $this->__('Полное описание'),
			'cols' => 70,
			'rows' => 15,
			'class' => 'mce',
		));

		$this->addElement('text', 'order', array(
			'label' => $this->__('Номер по порядку'),
		));
		
		$this->addElement('checkbox', 'enabled', array(
			'label'          => $this->__('Включен'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
		));
		
		$this->addElement('textarea', 'meta_keywords', array(
			'label' => $this->__('META тег "keywords"'),
			'rows' => 2,
		));
		
		$this->addElement('textarea', 'meta_description', array(
			'label' => $this->__('META тег "description"'),
			'rows' => 7,
		));
		
		$this->addDisplayGroup(array('title', 'alias', 'introtext', 'fulltext'), 'center');
		$this->addDisplayGroup(array('order', 'enabled', 'meta_keywords', 'meta_description'), 'right');
		
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
			Core::getBlock('contents/admin-posts/edit/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);
	}
}