<?php

class Application_Block_Default extends Core_Block_View
{
	public function isHomePage()
	{
		$request = $this->getRequest();
		if ('default' == $request->getParam('module')
			&& 'index' == $request->getParam('controller')
			&& 'index' == $request->getParam('action')
		) {
			return true;
		}
		
		return false;
	}
}