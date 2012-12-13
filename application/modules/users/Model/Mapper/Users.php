<?php

class Users_Model_Mapper_Users extends Core_Model_Mapper_Abstract
{
	public function authenticate($model)
	{
		$result = Zend_Auth::getInstance()->authenticate($model);
		
		if ($result->isValid() === true) {
			Zend_Auth::getInstance()->getStorage()->write($result->getIdentity());
			return true;
		}
			
		return $result;
	}
}