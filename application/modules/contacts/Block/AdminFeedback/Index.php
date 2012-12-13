<?php

class Contacts_Block_AdminFeedback_Index extends Core_Block_Grid_Widget
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
			'name'           => 'feedback_sender',
			'type'           => 'hyperlink',
			'title'          => $this->__('Имя'),
			'th-align'       => 'left',
			'linkOptions'       => 'contacts/admin-feedback/answer',
			'linkBindFields'    => array('id'),
			'width'          => '30%',
		));

		$this->addColumn(array(
			'name'           => 'message',
			'title'          => $this->__('Сообщение'),
			'th-align'       => 'left',
		));
		
		$this->addColumn(array(
			'type'              => 'hyperlink',
			'name'              => 'answer',
			'title'             => $this->__('Действие'),
			'linkStaticText'    => $this->__('Ответить'),
			'linkOptions'       => 'contacts/admin-feedback/answer',
			'linkBindFields'    => array('id'),
			'width'             => '1%',
			'nowrap'            => 'nowrap',
		));
		
		$this->setData(Core::getMapper('contacts/feedback')->fetchAll($this->createWhere()));

		$this->addBlockChild(
			Core::getBlock('contacts/admin-feedback/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'contacts/admin-feedback/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('contacts/feedback')->fetchCount($this->createWhere()),
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
}