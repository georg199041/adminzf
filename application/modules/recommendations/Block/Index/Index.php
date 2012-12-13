<?php

class Recommendations_Block_Index_Index extends Core_Block_View
{
	protected $_reccomendationsPosts;
	public function getRecommendationsPosts()
	{
		if (null === $this->_reccomendationsPosts) {
			$this->_reccomendationsPosts = Core::getMapper('recommendations/posts')->fetchAll(array(
				'enabled = ?' => 'YES'
			));
			
			if ($this->_reccomendationsPosts->count() == 0) {
				throw new Exception('Page not found');
			}
		}
		
		return $this->_reccomendationsPosts;
	}
}