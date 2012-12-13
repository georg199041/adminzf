<?php

class Documents_Block_Index_Index extends Core_Block_View
{
	protected $_documentsPosts;
	public function getDocumentsPosts()
	{
		if (null === $this->_documentsPosts) {
			$this->_documentsPosts = Core::getMapper('documents/posts')->fetchAll(array(
				'enabled = ?' => 'YES'
			), 'order');
			
			if ($this->_documentsPosts->count() == 0) {
				throw new Exception('Page not found');
			}
		}
		
		return $this->_documentsPosts;
	}
}