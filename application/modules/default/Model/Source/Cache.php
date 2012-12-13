<?php

class Default_Model_Source_Cache extends Core_Model_Source_DbTable
{
	protected $_cacheManager;
	
	protected $_cacheTemplates;
	
	public function setCacheManager(Zend_Cache_Manager $manager)
	{
		$this->_cacheManager = $manager;
		return $this;
	}
	
	public function getCacheManager()
	{
		if (null === $this->_cacheManager) {
			if (Zend_Registry::isRegistered('Zend_Cache_Manager')) {
				$this->setCacheManager(Zend_Registry::get('Zend_Cache_Manager'));
			} else if (Zend_Controller_Action_HelperBroker::hasHelper('cache')) {
				$this->setCacheManager(Zend_Controller_Action_HelperBroker::getStaticHelper('cache')->getManager());
			} else {
				$this->_cacheManager = false; // Prevent retry processing
			}
		}
	
		return $this->_cacheManager;
	}
	
	public function getCacheTemplates()
	{
		if (null === $this->_cacheTemplates) {
			if (!($this->getCacheManager() instanceof Zend_Cache_Manager)) {
				$this->_cacheTemplates = array();
			} else {
				$r = new Zend_Reflection_Class($this->getCacheManager());
				$p = $r->getProperty('_optionTemplates');
				$p->setAccessible(true);
				$this->_cacheTemplates = $p->getValue($this->getCacheManager());
			}
		}
		
		return $this->_cacheTemplates;
	}
	
	public function find($id)
	{
		if ($this->getCacheManager() instanceof Zend_Cache_Manager) {
			if (in_array($id, array('default', 'page', 'pagetag'))) {
				return null;
			}
			
			if ($this->getCacheManager()->hasCache($id)) {
				$cache = $this->getCacheManager()->getCache($id);
				return array(
					'id'       => $id,
					'label'    => $cache->getOption('label'),
					'lifetime' => $cache->getOption('lifetime'),
					'caching'  => $cache->getOption('caching'),
					'logging'  => $cache->getOption('logging'),
				);				
			}
		}
		
		return null;
	}
	
	public function fetchAll()
	{
		$return = array();
		if ($this->getCacheManager() instanceof Zend_Cache_Manager) {
			foreach ($this->getCacheManager()->getCaches() as $name => $row) {
				if (in_array($name, array('default', 'page', 'pagetag'))) {
					continue;
				}
				
				$return[] = array(
					'id'       => $name,
					'label'    => $row->getOption('label'),
					'lifetime' => $row->getOption('lifetime'),
					'caching'  => $row->getOption('caching'),
					'logging'  => $row->getOption('logging'),
				);
			}
		}
		
		return $return;
	}
	
	public function update($data, $id)
	{
		if ($this->getCacheManager() instanceof Zend_Cache_Manager) {
			if ($this->getCacheManager()->hasCache($id)) {
				// Update template (merge options)
				$cache = $this->getCacheManager()->getCache($id);
				$cache->setOption('caching', (bool) $data['caching']);
				$cache->setOption('logging', (bool) $data['logging']);
				
				// Collect options
				$cm   = array();
				$rows = $this->fetchAll();
				foreach ($rows as $row) {
					$cm[$row['id']] = array(
						'frontend' => array(
							'options' => array(
								'caching' => $row['caching'],
								'logging' => $row['logging'],
							)
						)
					);
				}
				
				// Create and save config
				$config = new Zend_Config(array('resources' => array('cachemanager' => $cm)));				
				$writer = new Zend_Config_Writer_Array();
				$writer->write(APPLICATION_PATH . '/configs/zend_cache.config.php', $config);
			}
		}
	}
	
	public function clean($id)
	{
		if ($this->getCacheManager() instanceof Zend_Cache_Manager) {
			if ($this->getCacheManager()->hasCache($id)) {
				$cache = $this->getCacheManager()->getCache($id);
				$cache->clean();
			}
		}
	}
}