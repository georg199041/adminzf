<?php

class Videogallery_Block_AdminVideos_Index extends Core_Block_Grid_Widget
{
	public function init()
	{
		$this->setAttribute('width', '100%');
		$this->setAttribute('cellpadding', 0);
		$this->setAttribute('cellpadding', 0);
		
		$this->addColumn(array(
			'name' 	=> 'ids',
			'type' 	=> 'checkbox',
			'title' => '<input type="checkbox" />',
			'width' => '1%',				
		));
		
		$this->addColumn(array(
			'name' 	=> 'id',
			'title' => $this->__('ID'),
			'width' => '50',
			'align' => 'right',				
		));
		
		$this->addColumn(array(
			'name' 			 => 'title',
			'type' 			 => 'hyperlink',
			'title' 		 => $this->__('Title'),
			'th-align' 		 => 'left',
			'linkOptions' 	 => '*/*/edit',
			'linkBindFields' => array('id'),							
		));
		
		$this->AddColumn(array(
			'name' 				=> 'enabled',
			'type' 				=> 'checkbox',
			'title' 			=> $this->__('On'),
			'checkedValue' 		=> 'YES',
			'uncheckedValue' 	=> 'NO',
			'width' 			=> '1%',
			'formactionOptions' => 	'*/*/enabled',
			'formactionBind'	=> array('value' => 'enabled', 'ids' => 'id')								
		));
		
		$this->addColumn(array(
			'type' => 'hyperlink',
			'name' => 'videogallery_albums_id',
			'title' => $this->__('Альбом'),
			'linkOptions' => 'videogallery/admin-albums/index',
			'linkBindFields' => array('videogallery_albums_id'),
			'width' => '1%',
			'nowrap' => 'nowrap',
			'filtrable' => 'true',
			'filtrableType' => Core_Block_Grid_Widget::FILTER_SELECT,
			'filtrableOptions' => $this->getVideogalleryAlbumsId(),										
		));
		
		$this->addBlockChild(
			Core::getBlock('videogallery/admin-videos/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE			
		);
		
		$this->addBlockChild(array(
			'blockName' => 'videogallery/admin-videos/index/pagination',
			'type' => 'pagination',
			'totalItemsCount' => Core::getMapper('videogallery/videos')->fetchCount($this->createWhere()),				
		), self::BLOCK_PLACEMENT_AFTER);
		
		$this->setData(Core::getMapper('videogallery/videos')->fetchAll(
			$this->createWhere(),
			null,
			$this->getBlockChild('videogallery/admin-videos/index/pagination')->getItemCountPerPage(),
			Core::getmapper('videogallery/videos')->pageToOffset(
				$this->getBlockChild('videogallery/admin-videos/index/pagination')->getItemCountPerPage(),
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
					$were[$name . ' = ?'] = $options['value'];
					break;
				case self::FILTER_LIKE:
					$where[$name . ' LIKE "%?%"'] = new Zend_Db_Expr($options['value']);
					break;		
			}
		}
		
		return $where;
	}
	
	protected function _formatVideogalleryAlbumsTree($collection, array $reult = array(), $depth = 0)
	{
		foreach ($collection as $item) {
			$result[$item->getId()] = str_repeat('--', $depth) ." ". $item->getTitle(); 
			$result = $this->_formatVideogalleryAlbumsTree($item->getChilds(), $result, $depth + 1);
		}
		
		return $result;
	}
	
	protected $_videogalleryAlbumsId;
	public function getVideogalleryAlbumsId()
	{
		if (null === $this->_videogalleryAlbumsId) {
			$this->_videogalleryAlbumsId = $this->_formatVideogalleryAlbumsTree(Core::getMapper('videogallery/albums')->fetchTree(), array('Нет'));
		}
		
		return $this->_videogalleryAlbumsId;
	}
} 