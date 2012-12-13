<?php

class Application_Block_Admin_Messenger extends Core_Block_View
{
	const TYPE_ERROR   = 'ERROR';
	const TYPE_WARNING = 'WARNING';
	const TYPE_SUCCESS = 'SUCCESS';
	const TYPE_INFO    = 'INFO';
	
	protected $_messages = array();
	
	protected $_defaultNamespace = 'Application_Admin_Messenger';
	
	protected $_sessionNamespace;
	
	protected $_session;
	
	public function __construct()
	{
		$this->getSession();
	}
	
	public function setSessionNamespace($namespace)
	{
		$this->_sessionNamespace = (string) $namespace;
		return $this;
	}
	
	public function getSessionNamespace()
	{
		if (null === $this->_sessionNamespace) {
			$this->setSessionNamespace($this->_defaultNamespace);
		}
		
		return $this->_sessionNamespace;
	}
	
	public function setSession(Zend_Session_Namespace $session)
	{
		$this->_session = $session;
		return $this;
	}
	
	public function getSession()
	{
		if (null === $this->_session) {
			$session = new Zend_Session_Namespace($this->getSessionNamespace());
			if (!is_array($session->messages)) {
				$session->messages = (array) $session->messages;
			}
			
			if (count($session->messages) > 0) {
				foreach ($session->messages as $pos => $message) {
					$this->addMessage($message['message'], $message['type'], false);
					unset($session->messages[$pos]);
				}
			}
			
			$this->setSession($session);
		}
		
		return $this->_session;
	}
	
	public function addMessage($message, $type = self::TYPE_INFO, $afterRedirect = true)
	{
		if (true === $afterRedirect) {
			$this->getSession()->messages[] = array('type' => $type, 'message' => $message);
		} else {
			$this->_messages[] = array('type' => $type, 'message' => $message);
		}
		
		return $this;
	}
	
	public function addError($message, $afterRedirect = true)
	{
		$this->addMessage($message, self::TYPE_ERROR, $afterRedirect);
		return $this;
	}
	
	public function addWarning($message, $afterRedirect = true)
	{
		$this->addMessage($message, self::TYPE_WARNING, $afterRedirect);
		return $this;
	}
	
	public function addSuccess($message, $afterRedirect = true)
	{
		$this->addMessage($message, self::TYPE_SUCCESS, $afterRedirect);
		return $this;
	}
	
	public function getMessagesCount($type = null)
	{
		return count($this->getMessages($type));
	}
	
	public function getMessages($type = null)
	{
		$messages = array();
		if (in_array($type, array(self::TYPE_ERROR, self::TYPE_WARNING, self::TYPE_SUCCESS, self::TYPE_INFO))) {
			foreach ($this->_messages as $message) {
				if ($message['type'] == $type) {
					$messages[] = $message;
				}
			}
		} else {
			foreach ($this->_messages as $message) {
				$messages[] = $message;
			}
		}
		
		return $messages;
	}
	
	public function clearMessages($type = null)
	{
		if (in_array($type, array(self::TYPE_ERROR, self::TYPE_WARNING, self::TYPE_SUCCESS, self::TYPE_INFO))) {
			foreach ($this->_messages as $pos => $message) {
				if ($message['type'] == $type) {
					unset($this->_messages[$pos]);
				}
			}
		} else {
			$this->_messages = array();
		}
		
		return $this;
	}
	
	public function render($name)
	{
		foreach ($this->getMessages() as $message) {
			$class = 'message_info';
			if ($message['type'] == 'ERROR') {
				$class = 'message_error';
			} else if ($message['type'] == 'WARNING') {
				$class = 'message_warning';
			} else if ($message['type'] == 'SUCCESS') {
				$class = 'message_success';
			}
				
			$response .= '<li class="message ' . $class . ' message_unreaded">' . PHP_EOL
			          .  '<a class="close" href="#"></a>' . PHP_EOL
			          .  '<span>' . $message['message'] . '</span>' . PHP_EOL
			          .  '</li>';
		}
		
		$this->clearMessages();
		
		return '<ul class="messages">' . PHP_EOL . $response . PHP_EOL . '</ul>';
	}
}