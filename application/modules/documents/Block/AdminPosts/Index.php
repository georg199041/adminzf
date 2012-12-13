<?php

class Documents_Block_AdminPosts_Index extends Core_Block_Grid_Widget
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
			'width' => '2',
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
			Core::getBlock('documents/admin-posts/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'documents/admin-posts/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('documents/posts')->fetchCount($this->createWhere()),
		), self::BLOCK_PLACEMENT_AFTER);
		
		$this->setData(Core::getMapper('documents/posts')->fetchAll(
			$this->createWhere(),
			null,
			$this->getBlockChild('documents/admin-posts/index/pagination')->getItemCountPerPage(),
			Core::getMapper('photogallery/images')->pageToOffset(
				$this->getBlockChild('documents/admin-posts/index/pagination')->getItemCountPerPage(),
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