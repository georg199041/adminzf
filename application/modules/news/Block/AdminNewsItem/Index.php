<?php

class News_Block_AdminNewsItem_Index extends Core_Block_Grid_Widget
{
	public function init()
	{
		$this->setAttribute('width', '100%');
		$this->setAttribute('cellpadding', 0);
		$this->setAtribute('cellpadding', 0);
		
		$this->addColumn(array(
			'name' 	=> 'ids',
			'type' 	=> 'checkbox',
			'title'	=> '<input type="checkbox />',
			'width' => '1%',			
		));
		
		$this->addColumn(array(
			'name' => 'id',
			'title' => $this->__('ID'),
			'width' => '50',
			'align' => 'right',				
		));
		
		$this->addColumn(array(
			'name' 			 => 'title',
			'type' 			 => 'hyperlink',
			'title' 		 => $this->__('Title'),
			'th-align'  	 => '*/*/edit',
			'linkOptions' 	 => '*/*/edit',
			'linkBindFields' => array('id'),						
		));
		
		$this->addColumn(array(
			'name' 				=> 'enabled',
			'type' 				=> 'checkbox',
			'title' 			=> $this->__('On'),
			'checkvalue' 		=> 'YES',
			'width' 			=> '1%',
			'formactionOptions' => '*/*/enabled',
			'formactionBind' 	=> array('value' => 'enabled', 'ids' => 'id')							
		));
		
		$this->addColumn(array(
			'type' 			   => 'hyperlink',
			'name' 			   => 'news_item_id',
			'title' 		   => $this->__('Новость'),
			'linkOptions'      => 'news/admin-news-item/index',
			'linkBindFields'   => array('news_item_id'),
			'width' 		   => '1%',
			'nowrap' 		   => 'nowrap',
			'filtrable'	 	   => 'true',
			'filtrableType'    => Core_Block_Grid_Widget::FILTER_SELECT,
			'filtrableOptions' => $this->getNewsItemsId(),										
		));
		
		$this->addBlockChild(Core::getBlock('news/admin-news-item/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);
		
		$this->addBlockChild(array(
			'blockName'	=> 'news/admin-news-item/index/paggination',
			'type'	    => 'paggination', 
			'totalItemsCount' => Core::getMapper('news/news-item')-fetchCount($this->createWhere()),		
		), self::BLOCK_PLACEMENT_AFTER);
		
		$this->setData(Core::getMapper('news/news-item')->fetchAll(
			$this->createWhere(),
			null,
			$this->getBlockChild('news/admin-news-item/index/pagination')->getItemCountPerPage(),
			Core::getMapper('news/news-item')->pageToOffset(
				$this->getBlockChild('news/admin-news-item/index/pagination')->getItemCountPerPage(),
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
					$where[$name . ' =?'] = $options['value'];
					break;
				case self::FILTER_LIKE:
					$where[$name . ' LIKE "%?%'] = new Zend_Db_Expr($options['value']);
					break;		
			}
		}
		
		return $where;
	}
	
	protected function _formatNewsItemTree($collection, array $result = array(), $depth = 0)
	{
		foreach ($collection as $item) {
			$result[$item->getId()] = str_repeat('--', $depth) ." ". $item->getTitle();
			$result = $this->_formatNewsItemTree($item->getChilds(), $result, $depth + 1);
		}
		
		return $result;
	}
	
	protected $_newsItemId;
	public function getNewsItemId()
	{
		if (null === $this>_newsItemId) {
			$this->_newsItemId = $this->_formatNewsItemTree(Core::getMapper('news/news-item')->fetchTree(), array('Нет'));
		}
		
		return $this->_newsItemId;
	}
}