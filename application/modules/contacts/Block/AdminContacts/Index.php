<?php

class Contacts_Block_AdminContacts_Index extends Core_Block_Grid_Widget
{
	public function init()
	{
		$this->setAttribute('width', '100%');		
		$this->setAttribute('cellpadding', 0);		
		$this->setAttribute('cellspacing', 0);
		
		$this->addColumn(array(
			'name'  => 'ids',
			'type'  => 'checkbox',
			'title' => '<input type="checkbox" />',
			'width' => '1%',
		));
		
		$this->addColumn(array(
			'name'  => 'id',
			'title' => $this->__('ID'),
			'width' => '50',
			'align' => 'right',
		));
		
		$this->addColumn(array(
			'name'           => 'title',
			'type'           => 'hyperlink',
			'title'          => $this->__('Заголовок'),
			'th-align'       => 'left',
			'linkOptions'    => '*/*/edit',
			'linkBindFields' => array('id'),
		));
		
		$this->addColumn(array(
			'name'   => 'alias',
			'title'  => $this->__('Псевдоним'),
			'width'  => '1%',
			'nowrap' => 'nowrap',
			'filterable'     => 'true',
			'filterableType' => Core_Block_Grid_Widget::FILTER_LIKE,
		));
		
		$this->addColumn(array(
			'type'              => 'hyperlink',
			'name'              => 'contacts_groups_id',
			'title'             => $this->__('Группа'),
			'linkOptions'       => 'contacts/admin-groups/index',
			'linkBindFields'    => array('contacts_groups_id'),
			'width'             => '1%',
			'nowrap'            => 'nowrap',
			'filterable'        => 'true',
			'filterableType'    => Core_Block_Grid_Widget::FILTER_SELECT,
			'filterableOptions' => $this->getContactsGroupsId(),
		));
		
		$this->addColumn(array(
			'name'              => 'enabled',
			'type'              => 'checkbox',
			'title'             => $this->__('Вкл'),
			'align'             => 'center',
			'checkedValue'      => 'YES',
			'uncheckedValue'    => 'NO',
			'width'             => '1%',
			'formactionOptions' => '*/*/enabled',
			'formactionBind'    => array('value' => 'enabled', 'ids' => 'id')
		));
		
		$this->setData(Core::getMapper('contacts/contacts')->fetchAll($this->createWhere()));

		$this->addBlockChild(
			Core::getBlock('contacts/admin-contacts/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'contacts/admin-contacts/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('contacts/contacts')->fetchCount($this->createWhere()),
		), self::BLOCK_PLACEMENT_AFTER);
	}
	
	public function createWhere()
	{
		if (count($this->getFilterValues()) == 0) {
			return null;
		}
		
		$where = array();
		foreach ($this->getFilterValues() as $name => $options) {
			switch ($options['type']) {
				case self::FILTER_EQUAL:
				case self::FILTER_SELECT:
					$where[$name . ' = ?'] = $options['value'];
					break;
				case self::FILTER_LIKE:
					$where[$name . ' LIKE "%?%"'] = new Zend_Db_Expr($options['value']);
					break;
			}
		}
		
		return $where;
	}
	
	protected $_contactsGroupsId;
	public function getContactsGroupsId()
	{
		if (null === $this->_contactsGroupsId) {
			$groups = Core::getMapper('contacts/groups')->fetchAll();
			$this->_contactsGroupsId = array('--- NO ---');
			
			foreach ($groups as $group) {
				$this->_contactsGroupsId[$group->getId()] = $group->getTitle();
			}
		}
		
		return $this->_contactsGroupsId;
	}
}