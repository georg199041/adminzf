<?php

class Contacts_Model_Entity_Feedback extends Core_Model_Entity_Abstract
{
	public function getFeedbackSender()
	{
		return $this->getName() . ' (' . $this->getEmail() . ')';
	}
}