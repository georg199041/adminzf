<?php

class Navigation_Block_AdminPages_Index extends Core_Block_Grid_Widget
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
			'name'           => 'label',
			'type'           => 'hyperlink',
			'title'          => $this->__('Заголовок'),
			'th-align'       => 'left',
			'linkOptions'    => '*/*/edit',
			'linkBindFields' => array('id'),
		));

		$this->addColumn(array(
			'name'  => 'type',
			'title' => $this->__('Тип'),
			'width' => '1%',
		));
		
		$this->addColumn(array(
			'name'           => 'encode_url',
			'type'           => 'checkbox',
			'title'          => $this->__('Кодировать'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
			'width'          => '1%',
		));
		
		$this->addColumn(array(
			'name'           => 'reset_params',
			'type'           => 'checkbox',
			'title'          => $this->__('Сброс'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
			'width'          => '1%',
		));

		$this->addColumn(array(
			'name'           => 'enabled',
			'type'           => 'checkbox',
			'title'          => $this->__('Вкл.'),
			'align'             => 'center',
			'checkedValue'      => 'YES',
			'uncheckedValue'    => 'NO',
			'width'             => '1%',
			'formactionOptions' => '*/*/enabled',
			'formactionBind'    => array('value' => 'enabled', 'ids' => 'id')
		));
		
		$this->addColumn(array(
			'type'              => 'hyperlink',
			'name'              => 'navigation_pages_id',
			'title'             => $this->__('Родитель'),
			'linkOptions'       => 'navigation/admin-pages/index',
			'linkBindFields'    => array('filter[navigation_pages_id]' => 'navigation_pages_id'),
			'width'             => '1%',
			'nowrap'            => 'nowrap',
			'filterable'        => 'true',
			'filterableType'    => Core_Block_Grid_Widget::FILTER_SELECT,
			'filterableOptions' => $this->getNavigationPagesId(),
		));
		
		$this->setData(Core::getMapper('navigation/pages')->fetchAll());

		$this->addBlockChild(
			Core::getBlock('navigation/admin-pages/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'navigation/admin-pages/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('navigation/pages')->fetchCount(),
		), self::BLOCK_PLACEMENT_AFTER);
	}
	
	protected function _formatNavigationPagesTree($collection, array $result = array(), $depth = 0)
	{
		foreach ($collection as $item) {
			$result[$item->getId()] = str_repeat('--', $depth) ." ". $item->getLabel();
			$result = $this->_formatNavigationPagesTree($item->getChilds(), $result, $depth + 1);
		}
		
		return $result;
	}
	
	protected $_navigationPagesId;
	public function getNavigationPagesId()
	{
		if (null === $this->_navigationPagesId) {
			$this->_navigationPagesId = $this->_formatNavigationPagesTree(Core::getMapper('navigation/pages')->fetchTree(), array('Нет'));
		}
		
		return $this->_navigationPagesId;
	}
}