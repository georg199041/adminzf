<?php

class Staff_Block_AdminStaff_Index extends Core_Block_Grid_Widget
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
			'width' => '1%',
			'align' => 'right',
		));
		
		$this->addColumn(array(
			'name'           => 'name',
			'type'           => 'hyperlink',
			'title'          => $this->__('Имя'),
			'th-align'       => 'left',
			'linkOptions'    => '*/*/edit',
			'linkBindFields' => array('id'),
		));
		
		$this->addColumn(array(
			'name'  => 'grid_order',
			'width' => '1%',
			'align' => 'right',
			'title' => $this->__('№п/п'),
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

		$this->addBlockChild(
			Core::getBlock('staff/admin-staff/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'staff/admin-staff/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('staff/staff')->fetchCount($this->createWhere()),
		), self::BLOCK_PLACEMENT_AFTER);
		
		$this->setData(Core::getMapper('staff/staff')->fetchAll(
			$this->createWhere(),
			null,
			$this->getBlockChild('staff/admin-staff/index/pagination')->getItemCountPerPage(),
			Core::getMapper('photogallery/images')->pageToOffset(
				$this->getBlockChild('staff/admin-staff/index/pagination')->getItemCountPerPage(),
				$this->getRequest()->getParam('page', 1)
			)
		));
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