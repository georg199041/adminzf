<?php

class Users_Model_Entity_Users extends Core_Model_Entity_Abstract implements Zend_Auth_Adapter_Interface
{
	public function getRegisterTs()
	{
		return date('d.m.Y H:m', $this->_data['register_ts']);
	}
	
	public function save()
	{
		$this->delRepeatPassword();
		$this->setPassword(md5($this->getPassword()));
		parent::save();
	}
	
	public function authenticate()
	{
		try {
			$rows = $this->getMapper()->fetchAll(array(
				'email = ?'   => $this->getEmail(),
				'enabled = ?' => 'YES'
			));
			
			if ($rows->count() == 0) {
				return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND, null, array('Пользователь не найден'));
			} else if ($rows->count() > 1) {
				return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS, null, array('Ошибка авторизации (не однозначность)'));
			}
			
			$user = $rows->current();
			if ($user->getPassword() != md5($this->getPassword())) {
				return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID, null, array('Неправильный пароль'));
			}
			
			return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS , $user, array('Авторизация прошла успешно'));
		} catch (Exception $e) {
			return new Zend_Auth_Result(Zend_Auth_Result::FAILURE , null, array('Ошибка авторизации'));
		}
	}
}