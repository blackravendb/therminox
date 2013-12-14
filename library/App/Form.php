<?php
class App_Form extends Zend_Form
{
	function __construct()
	{
		parent::__construct();
		$this->addElement('hash', 'csrf_token', array(
				'ignore' => true,
				'salt' => get_class($this) . 'unique',
				'decorators' => array('ViewHelper')
		));
	}
}