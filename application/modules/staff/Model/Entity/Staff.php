<?php

class Staff_Model_Entity_Staff extends Core_Model_Entity_Abstract
{
	public function getGridOrder()
	{
		$order = $this->getOrder();
		return $order ? $order : '-';
	}
}