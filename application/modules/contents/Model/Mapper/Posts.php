<?php

class Contents_Model_Mapper_Posts extends Core_Model_Mapper_Abstract
{
	protected function _afterFetchRow($entity)
	{
		// get parent row
		// find relations by parent row
		// find parent relations
		// get parent row parents branch for use ids
		// get relations by parents branch ids
		// load params data
	}
	
	public function getStaticPost($alias)
	{
		return $this->fetchRow(array(
			'enabled = ?' => 'YES',
			'contents_categories_id IS NULL',
			'alias = ?' => $alias
		));
	}
}