<?php
class App_Acl extends Zend_Acl
{
	public function __construct()
	{
		$this->add(new Zend_Acl_Resource('index'));
		$this->add(new Zend_Acl_Resource('startseite'));
		$this->add(new Zend_Acl_Resource('account'));
		$this->add(new Zend_Acl_Resource('git'));
		$this->add(new Zend_Acl_Resource('error'));
		
		$this->addRole(new Zend_Acl_Role('gast'));
		$this->addRole(new Zend_Acl_Role('benutzer'), 'gast'); // erbt von gast
		$this->addRole(new Zend_Acl_Role('admin'), 'benutzer');

		$this->allow('gast');
// 		$this->allow('gast', 'index');
// 		$this->allow('gast', 'startseite');
// 		$this->allow('gast', 'account'); // löschen wenn Berechtigungen in DB eingepflegt sind
		
// 		//$this->allow('gast', 'account', array('login', 'register'));
		
// 		$this->allow('benutzer', 'index');
// 		$this->allow('benutzer', 'startseite');
// 		$this->allow('benutzer', 'account');
		
	}
}