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
		
		$this->addRole(new Zend_Acl_Role('Gast'));
		$this->addRole(new Zend_Acl_Role('Benutzer'), 'Gast'); // erbt von Gast
		$this->addRole(new Zend_Acl_Role('Administrator'), 'Benutzer');

		$this->allow('Gast');
// 		$this->allow('Gast', 'index');
// 		$this->allow('Gast', 'git');
// 		$this->allow('Gast', 'startseite');		
// 		$this->allow('Gast', 'account', array('login', 'register'));
		
// 		$this->allow('Benutzer', 'index');
// 		$this->allow('Benutzer', 'startseite');
// 		$this->allow('Benutzer', 'account');
		
	}
}