<?php

class Contents_Model_Entity_Posts extends Core_Model_Entity_Abstract
{
	public function getCreatedTs()
	{
		return date('d.m.Y', $this->_data['created_ts']);
	}
	
	public function getModifiedTs()
	{
		if (!$this->_data['modified_ts']) {
			return 'Never';
		}
		
		return date('d.m.Y', $this->_data['modified_ts']);
	}
}