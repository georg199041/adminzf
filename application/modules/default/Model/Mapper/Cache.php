<?php

class Default_Model_Mapper_Cache extends Core_Model_Mapper_Abstract
{
	public function find($id)
	{
		$entity = $this->create();
		$this->_beforeFetchRow($entity);
		
		$cache = $this->getSource()->find($id);
		if ($cache) {
			$entity->fill($cache);
		}
		
		$this->_afterFetchRow($entity);
		return $entity;
	}
	
	public function fetchAll()
	{
		$collection = $this->createCollection();		
		$this->_beforeFetchRows($collection);
		
		$rowset = $this->getSource()->fetchAll();
		foreach ($rowset as $row) {
			$entity = $this->create($row);
			$collection->push($entity);
		}
		
		$this->_afterFetchRows($collection);		
		return $collection;
	}
	
	public function save(Core_Model_Entity_Abstract $entity)
	{
		$this->_beforeSaveRow($entity);
		
		if ($entity->getId()) {
			$this->getSource()->update($entity->toArray(), $entity->getId());
		}
		
		$this->_afterSaveRow($entity);		
		return $this;
	}
	
	public function clean(Core_Model_Entity_Abstract $entity)
	{
		if ($entity->getId()) {
			$this->getSource()->clean($entity->getId());
		}
		
		return $this;
	}
}