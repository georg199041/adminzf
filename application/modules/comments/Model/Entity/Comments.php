<?php

class Comments_Model_Entity_Comments extends Core_Model_Entity_Abstract
{
	public function getUserinfo()
	{
		return '<div>' . $this->getName() . '</div>'
			 . '<div style="white-space: nowrap;">' . date('d.m.Y H:m', $this->getCreatedTs()) . '</div>'
		     . '<div><a href="mailto:' . $this->getEmail() . '">' . $this->getEmail() . '</a></div>'
			 . '<div>' . $this->getIp() . '</div>'
			 . '<div>' . $this->getUserAgent() . '</div>';		
	}
}