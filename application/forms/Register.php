<?php

class Application_Form_Register extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post')
    	->setAction('/account/register')
    	->setAttrib('id', 'register');
   
    	$email = new Zend_Form_Element_Text('email');
    	$email->setRequired(true)
    	->setLabel('Email-Adresse')
    	->setDecorators(array('ViewHelper', 'Label', 'Errors'))
    	->addErrorMessage('Bitte geben Sie eine gültige Email-Adresse an.')
    	->addValidator('emailAddress');
    	 
    	$password = new Zend_Form_Element_Password('password');
    	$password->setRequired(true)
    	->setLabel('Passwort')
    	->setDecorators(array('ViewHelper', 'Label', 'Errors'))
    	->addErrorMessage('Bitte geben Sie ein Passwort an.');
    	

    	$confirm_password = new Zend_Form_Element_Password('confirm_password');
    	$confirm_password->setRequired(true)
    	->setLabel('Passwort bestätigen')
    	->setDecorators(array('ViewHelper', 'Label', 'Errors'))
    	->addErrorMessage('Die Passwörter stimmen nicht überein.')
    	->addValidator('Identical', false, array('token' => 'password'));
    	
    	$title = new Zend_Form_Element_Select('title');
    	$title->setLabel('Anrede')
    	->setDecorators(array('ViewHelper', 'Label', 'Errors'))
    	->addErrorMessage('Bitte geben Sie Ihren Vornamen an.')
    	->addMultiOptions(array(
    			'herr' => 'Herr',
    			'frau' => 'Frau'
    	));
    	
    	
    	$name = new Zend_Form_Element_Text('name');
    	$name->setRequired(true)
    	->setLabel('Vorname')
    	->setDecorators(array('ViewHelper', 'Label', 'Errors'))
    	->addErrorMessage('Bitte geben Sie Ihren Vornamen an.')
    	->addValidator('Alpha');
    	
    	$lastname = new Zend_Form_Element_Text('lastname');
    	$lastname->setRequired(true)
    	->setLabel('Nachname')
    	->setDecorators(array('ViewHelper', 'Label', 'Errors'))
    	->addErrorMessage('Bitte geben Sie Ihren Nachnamen an.')
    	->addValidator('Alpha');
    	 
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('Registrieren')
    	->setDecorators(array('ViewHelper'));
    	
    	$this->setDecorators( array( array('ViewScript', array('viewScript' => '_form_register.phtml'))));
    	$this->addElements(array($email, $password, $confirm_password, $title, $name, $lastname, $submit));
    }


}

