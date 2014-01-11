<?php
class App_Acl extends Zend_Acl
{
	public function __construct()
	{
		$this->addRole(new Zend_Acl_Role('Gast'));
		$this->addRole(new Zend_Acl_Role('Benutzer'), 'Gast'); // erbt von Gast
		$this->addRole(new Zend_Acl_Role('Administrator'), 'Benutzer');
		
		$this->add(new Zend_Acl_Resource('admin'));
		$this->add(new Zend_Acl_Resource('account'));
		$this->add(new Zend_Acl_Resource('angebot'));
		$this->add(new Zend_Acl_Resource('artikel'));
		$this->add(new Zend_Acl_Resource('error'));
		$this->add(new Zend_Acl_Resource('git'));
		$this->add(new Zend_Acl_Resource('index'));
		$this->add(new Zend_Acl_Resource('pufferspeicher'));
		$this->add(new Zend_Acl_Resource('startseite'));
		$this->add(new Zend_Acl_Resource('waermetauscher'));
		$this->add(new Zend_Acl_Resource('wasserwaermer'));
		
		
		$this->allow('Gast'); 
		$this->deny('Gast', 'account'); //TODO deny moar stuff
		$this->deny('Gast', 'admin');
		$this->deny('Gast', 'angebot');
		$this->allow('Gast', 'account', array('login', 'register', 'confirm', 'recover', 'lost'));
		
 		$this->allow('Benutzer', 'account');
 		$this->allow('Benutzer', 'angebot');
 		
 		$this->allow('Administrator', 'admin');
 		$this->deny('Administrator', 'account', array('profile', 'update', 'delete', 'address'));
 		$this->deny('Administrator', 'angebot');
	}
}