<?php
class App_Form extends Zend_Form
{
	function __construct()
	{
		parent::__construct();
		$this->addElement('hash', 'csrf', array(
				'ignore' => true,
				'salt' => 'unique',
				'decorators' => array('ViewHelper')
		));
	}
}