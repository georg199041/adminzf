<?php

class News_Block_AdminNewsItem_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		$this->getForm()->setName('form_data');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('text', 'title', array(
			'label'    => $this->_('Заголовок'),
			'required' => true,		
		));
		
		$this->addElement('textarea', 'description', array(
			'label' => $this->__('Описание'),
			'cols'  => 70,
			'rows'  => 15,
			'class' => 'mce',				
		));
		
		$this->addElement('select', 'news_item_id', array(
			'label' => $this->__('Новость'),
			'multiOptions' => $this->getNewsItemId(),		
		));
		
		$this->addElement('checkbox', 'enabled', array(
			'label' => $this->__('Включено'),
			'checkedValue' => 'YES',
			'uncheckedValue' => 'NO',			
		));
		
		$this->addDisplayGroup(array('title', 'description'), 'center');
		
		if (isset(Core::getSession('admin')->formData)) {
			$this->setDefaults(Core::getSession('admin')->formData);
			unset(Core::getSession('admin')->formData);
		} elseif (Zend_Registry::isRegistered('form_data')) {
			$this->setDefaults(Zend_Registry::get('form_data'));
		}
		
		if (isset(Core::getSession('admin')->formHasErrors) && Core::getSession('admin')->formHasErrors) {
			$this->isValis($this->getValues());
			unset(Core::getSession('admin')->formHasErrors);
		}
		
		$this->addBlockChild(
			Core::getBlock('news/admin-news-item/edit/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE		
		);
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
		if (null === $this->_newsItemId) {
			$this->_newsItemId = $this->_formatNewsItemTree(Core::getMapper('news/news-item')->fetchTree(), array('Нет'));
		}
		
		return $this->_newsItemId;
	}
}