<?php

class Default_Model_Entity_Cache extends Core_Model_Entity_Abstract
{
	public function getGridLifetime()
	{
		$tz = date_default_timezone_get();
		date_default_timezone_set('UTC');
		
		$ts = (int) $this->getLifetime();		
		$dr = date('z', $ts) . 'д ' . date('H', $ts) . 'ч ' . date('i', $ts) . 'м ' . date('s', $ts) . 'с ';
		
		date_default_timezone_set($tz);
		return $dr;
	}
	
	public function clean()
	{
		$this->getMapper()->clean($this);
	}
}