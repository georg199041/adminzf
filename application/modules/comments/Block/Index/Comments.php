<?php

class Comments_Block_Index_Comments extends Core_Block_View
{
	protected $_comments = array();
	public function getComments()
	{
		if (null === $this->_comments[$this->getCommentsTable()][$this->getCommentsTableId()]) {
			$this->_comments[$this->getCommentsTable()][$this->getCommentsTableId()] = Core::getMapper('comments/comments')->fetchAll(array(
				'`status` = ?'   => 'MODERATED',
				'`table` = ?'    => $this->getCommentsTable(),
				'`table_id` = ?' => $this->getCommentsTableId()
			));
		}
		
		return $this->_comments[$this->getCommentsTable()][$this->getCommentsTableId()];
	}
	
	protected $_commentsTable   = '';
	protected $_commentsTableId = 0;
	public function setCommentsTable($table)
	{
		$this->_commentsTable = (string) $table;
		return $this;
	}
	
	public function getCommentsTable()
	{
		return $this->_commentsTable;
	}
	
	public function setCommentsTableId($tableId)
	{
		$this->_commentsTableId = (int) $tableId;
		return $this;
	}
	
	public function getCommentsTableId()
	{
		return $this->_commentsTableId;
	}
}