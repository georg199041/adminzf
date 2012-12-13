<?php

/** UNCOMMENT only one of below requires depended on this file location */

/** Require if controller file in modules subfolder of application */
require_once realpath(dirname(dirname(dirname(dirname(__FILE__)))) . '/ControllerTestCaseAbstract.php');

/** Require if controller file in controllers folder of application */
//require_once realpath(dirname(dirname(__FILE__)) . '/ControllerTestCaseAbstract.php');

class IndexControllerTest extends ControllerTestCaseAbstract
{
	/**
	 * Test if unlogged user go to index page
	 */
	public function testIndexUnlogined()
	{
		$this->dispatch("/");
		$this->assertResponseCode(200);
		$this->assertAction('authorization-error');
		$this->assertController('error');
	}
	
	/**
	 * Check if login process complete without fatal errors
	 */
	public function testLogin()
	{
		$this->request->setPost(array(
			'phone'  => 'bat',
		    'password' => 'bogus',
		));
		
		$this->request->setHeader('X-Requested-With', 'XmlHttpRequest');
		$this->request->setMethod('POST');
		
		$this->dispatch('/index/login');
		
		$this->assertResponseCode(200);
		$this->assertAction('login');
		$this->assertController('index');
	}
}