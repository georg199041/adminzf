<?php

class Videogallery_Block_AdminVideos_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		$this->getForm()->setName('form_data');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('text', 'title', array(
			'label' => $this->__('Заголовок'),
			'required'	=> true,	
		));
		
		$this->addElement('textarea', 'description', array(
			'label' => $this->__('Описание'),
			'cols' => 70,
			'rows' => 15,
			'class' => 'mce',				
		));
		
		$this->addElements('select', 'videogallery_albums_id', array(
			'label' => $this->__('Альбом'),
			'multiOptions' => $this->getVideogalleryAlbumsId(),		
		));
		
		$this->addElement('text', 'video', array(
			'label' => $this->__('Видео'),	
		));
		
		$this->getElement('image')->setDecorators(array(
			array('CombinatedElement', array('btns' => array('select' => array('label' => 'Выбрать'))))	
		));
		
		$this->addElement('checkbox', 'enabled', array(
			'label' => $this->__('Включено'),
			'checkedValue' => 'YES',
			'uncheckedValue' => 'NO',			
		));
		
		$this->addDisplayGroup(array('title', 'description'), 'center');
		$this->addDisplayGroup(array('videogallery_albums_id', 'video', 'enabled'), 'right');
		
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
			Core::getBlock('videogallery/admin-videos/edit/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE		
		);
		
	}
	
	protected function _formatVideogalleryAlbumsTree($collection, array $result = array(), $depth = 0)
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