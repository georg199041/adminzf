<?php

class Photogallery_Block_AdminImages_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		$this->getForm()->setName('form_data');

		$this->addElement('hidden', 'id');

		$this->addElement('text', 'title', array(
			'label'    => $this->__('Заголовок'),
			'required' => true,
		));
		
		$this->addElement('textarea', 'description', array(
			'label' => $this->__('Описание'),
			'cols' => 70,
			'rows' => 15,
			'class' => 'mce',
		));
		
		$this->addElement('select', 'photogallery_albums_id', array(
			'label'        => $this->__('Альбом'),
			'multiOptions' => $this->getPhotogalleryAlbumsId(),
		));

		$this->addElement('text', 'image', array(
			'label' => $this->__('Картинка'),
		));
		$this->getElement('image')->setDecorators(array(
			array('CombinedElement', array('btns' => array('select' => array('label' => 'Выбрать'))))
		));
		
		$this->addElement('checkbox', 'enabled', array(
			'label'          => $this->__('Включено'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
		));
		
		$this->addDisplayGroup(array('title', 'description'), 'center');
		$this->addDisplayGroup(array('photogallery_albums_id', 'image', 'enabled'), 'right');

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
				Core::getBlock('photogallery/admin-images/edit/toolbar'),
				self::BLOCK_PLACEMENT_BEFORE
		);
	}

	protected function _formatPhotogalleryAlbumsTree($collection, array $result = array(), $depth = 0)
	{
		foreach ($collection as $item) {
			$result[$item->getId()] = str_repeat('--', $depth) ." ". $item->getTitle();
			$result = $this->_formatPhotogalleryAlbumsTree($item->getChilds(), $result, $depth + 1);
		}
	
		return $result;
	}
	
	protected $_photogalleryAlbumsId;
	public function getPhotogalleryAlbumsId()
	{
		if (null === $this->_photogalleryAlbumsId) {
			$this->_photogalleryAlbumsId = $this->_formatPhotogalleryAlbumsTree(Core::getMapper('photogallery/albums')->fetchTree(), array('Нет'));
		}
	
		return $this->_photogalleryAlbumsId;
	}
}