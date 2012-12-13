<?php

class Contents_Block_AdminPosts_Index extends Core_Block_Grid_Widget
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
			'name'           => 'title',
			'type'           => 'hyperlink',
			'title'          => $this->__('Title'),
			'th-align'       => 'left',
			'linkOptions'    => '*/*/edit',
			'linkBindFields' => array('id'),
		));
		
		$this->addColumn(array(
			'name'   => 'alias',
			'title'  => $this->__('Alias'),
			'width'  => '1%',
			'nowrap' => 'nowrap',
		));

		$this->addColumn(array(
			'name'  => 'grid_order',
			'width' => '1%',
			'align' => 'right',
			'title' => $this->__('№п/п'),
		));
		
		$this->addColumn(array(
			'name'           => 'enabled',
			'type'           => 'checkbox',
			'title'          => $this->__('On'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
			'width'          => '1%',
			'formactionOptions' => '*/*/enabled',
			'formactionBind'    => array('value' => 'enabled', 'ids' => 'id')
		));

		$this->addColumn(array(
			'type'              => 'hyperlink',
			'name'              => 'contents_categories_id',
			'title'             => $this->__('Категория'),
			'linkOptions'       => 'contents/admin-categories/index',
			'linkBindFields'    => array('contents_categories_id'),
			'width'             => '1%',
			'nowrap'            => 'nowrap',
			'filterable'        => 'true',
			'filterableType'    => Core_Block_Grid_Widget::FILTER_SELECT,
			'filterableOptions' => $this->getContentsCategoriesId(),
		));

		$this->addBlockChild(
			Core::getBlock('contents/admin-posts/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'contents/admin-posts/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('contents/posts')->fetchCount($this->createWhere()),
		), self::BLOCK_PLACEMENT_AFTER);
		
		$this->setData(Core::getMapper('contents/posts')->fetchAll(
			$this->createWhere(),
			null,
			$this->getBlockChild('contents/admin-posts/index/pagination')->getItemCountPerPage(),
			Core::getMapper('photogallery/images')->pageToOffset(
				$this->getBlockChild('contents/admin-posts/index/pagination')->getItemCountPerPage(),
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
	
	protected $_contentsCategoriesId;
	public function getContentsCategoriesId()
	{
		if (null === $this->_contentsCategoriesId) {
			$groups = Core::getMapper('contents/categories')->fetchAll();
			$this->_contentsCategoriesId = array('Нет');
				
			foreach ($groups as $group) {
				$this->_contentsCategoriesId[$group->getId()] = $group->getTitle();
			}
		}
		
		return $this->_contentsCategoriesId;
	}
}