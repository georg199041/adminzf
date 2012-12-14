<?php

class Navigation_Block_AdminPages_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		$this->getForm()->setName('form_data');
		$this->addElement('hidden', 'id');
		
		$this->addElement('select', 'navigation_pages_id', array(
			'label'        => $this->__('Родитель'),
			'multiOptions' => $this->getNavigationPagesId(Core::getMapper('navigation/pages')->fetchTree(), array('Нет')),
		));
		
		$this->addElement('text', 'label', array(
			'label'    => $this->__('Заголовок'),
			'required' => true,
		));

		$this->addElement('text', 'uri', array(
			'label' => $this->__('УРЛ'),
		));
		
		$this->addElement('text', 'module', array(
			'label' => $this->__('Модуль'),
		));

		$this->addElement('text', 'controller', array(
			'label' => $this->__('Контроллер'),
		));

		$this->addElement('text', 'action', array(
			'label' => $this->__('Действие'),
		));

		$this->addElement('select', 'route', array(
			'label'        => $this->__('Роут'),
			'multiOptions' => $this->getNavigationRoutes(),
		));
		
		$this->addElement('textarea', 'params', array(
			'label' => $this->__('Параметры'),
			'rows' => 4,
			'cols' => 70,
		));
		
		$this->addElement('select', 'type', array(
			'label'        => $this->__('Тип'),
			'multiOptions' => array(
				'MVC' => $this->__('Конструктор'),
				'URI' => $this->__('Ссылка'),
			)
		));

		$this->addElement('checkbox', 'reset_params', array(
			'label'          => $this->__('Сбрасывать'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
		));

		$this->addElement('checkbox', 'encode_url', array(
			'label'          => $this->__('Кодировать спец символы'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
			'value'          => 'NO',
		));
		
		$this->addElement('checkbox', 'enabled', array(
			'label'          => $this->__('Включено'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
			'value'          => 'YES',
		));
		
		$this->addDisplayGroup(array('navigation_pages_id', 'label', 'uri', 'module', 'controller', 'action', 'params'), 'center');
		$this->addDisplayGroup(array('route', 'type', 'enabled', 'reset_params', 'encode_url'), 'right');
		
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
			Core::getBlock('navigation/admin-pages/edit/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);
	}
	
	public function getNavigationPagesId($collection, array $result = array(), $depth = 0)
	{
		foreach ($collection as $item) {
			$result[$item->getId()] = str_repeat('--', $depth) . $item->getLabel();
			$result = $this->getNavigationPagesId($item->getChilds(), $result, $depth + 1);
		}
		
		return $result;
	}
	
	public function getNavigationRoutes()
	{
		$config = Zend_Registry::get('config');
		
		$routes = array();		
		foreach ((array) $config['resources']['router']['routes'] as $name => $options) {
			$label = (string) $options['label'];
			if (!$label) {
				$label = ucfirst(str_ireplace(array('-', '_'), ' ', $name));
			}
			
			$routes[$name] = $this->__($label);
		}
		
		return $routes;
	}
}