<?php

class Documents_Model_Entity_Posts extends Core_Model_Entity_Abstract
{
	public function getGridOrder()
	{
		$order = $this->getOrder();
		return $order ? $order : '-';
	}
}