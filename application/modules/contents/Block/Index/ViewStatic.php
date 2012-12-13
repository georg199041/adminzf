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
			if ($this->_post->getMetaKeywords()) {
				$this->headMeta()->setName('keywords', $this->_post->getMetaKeywords());
			}
			
			if ($this->_post->getMetaDescription()) {
				$this->headMeta()->setName('description', $this->_post->getMetaDescription());
			}
		}
		
		return $this->_post;
	}
}