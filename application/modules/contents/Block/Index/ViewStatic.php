<?php

class Contents_Block_Index_ViewStatic extends Core_Block_View
{
	protected $_post;
	public function getPost()
	{
		if (null === $this->_post) {
			$this->_post = Core::getMapper('contents/posts')->getStaticPost($this->getRequest()->getParam('alias'));
			if (!$this->_post->getId()) {
				throw new Exception('Page not found');
			}
			$this->headTitle($this->_post->getTitle());
			$this->headMeta()->appendName('keywords', 'framework php productivity');
			$this->headMeta()->appendName('description', strip_tags($this->_post->getFulltext()));
		}
		
		return $this->_post;
	}
}