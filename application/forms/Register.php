<?php

class Application_Form_Register extends Zend_Form
{

	public $elementDecorators = array(
			'ViewHelper',
			'Errors',
			array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
			array('Label', array('tag' => 'td')),
			array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
	);
	
	public $buttonDecorators = array(
			'ViewHelper',
			array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
			array(array('label' => 'HtmlTag'), array('tag' => 'td', 'placement' => 'prepend')),
			array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
	);
	
    public function init()
    {
    	$this->setMethod('post')
    	->setAction('/account/register')
    	->setAttrib('id', 'register');
   
    	$email = new Zend_Form_Element_Text('email');
    	$email->setRequired(true)
    	->setLabel('Email-Adresse')
    	->setDecorators($this->elementDecorators)
    	->setValidators(array(
    		array('NotEmpty', true),
            array('EmailAddress', true)
        ))
    	->addErrorMessage('Bitte geben Sie eine gültige Email-Adresse an.');
    	 
    	$password = new Zend_Form_Element_Password('password');
    	$password->setRequired(true)
    	->setLabel('Passwort')
    	->setDecorators($this->elementDecorators)
    	->addErrorMessage('Bitte geben Sie ein Passwort an.');
    	
    	$confirm_password = new Zend_Form_Element_Password('confirm_password');
    	$confirm_password->setRequired(true)
    	->setLabel('Passwort bestätigen')
    	->setDecorators($this->elementDecorators)
    	->addErrorMessage('Die Passwörter stimmen nicht überein.')
    	->addValidator('Identical', false, array('token' => 'password'));
    	
    	$title = new Zend_Form_Element_Select('title');
    	$title->setLabel('Anrede')
    	->setDecorators($this->elementDecorators)
    	->addMultiOptions(array(
    			'herr' => 'Herr',
    			'frau' => 'Frau'
    	));
    	
    	
    	$name = new Zend_Form_Element_Text('name');
    	$name->setRequired(true)
    	->setLabel('Vorname')
    	->setDecorators($this->elementDecorators)
    	->setValidators(array(
    		array('NotEmpty', true),
            array('Alpha', true, array('allowWhiteSpace' => true)),
            array('StringLength', true, array('min' => 2, 'max' => 50))
        ));
    	$name->getValidator('NotEmpty')->setMessage('Bitte geben Sie Ihren Vornamen an.');
    	$name->getValidator('Alpha')->setMessage('Das Feld darf nur Buchstaben enthalten.');
    	$name->getValidator('StringLength')->setMessage('Der Vorname muss zwischen 2 und 50 Zeichen lang sein.');
    	
    	$lastname = new Zend_Form_Element_Text('lastname');
    	$lastname->setRequired(true)
    	->setLabel('Nachname')
    	->setDecorators($this->elementDecorators)
    	->setValidators(array(
    		array('NotEmpty', true),
            array('Alpha', true, array('allowWhiteSpace' => true)),
            array('StringLength', true, array('min' => 2, 'max' => 50))
        ));
    	$lastname->getValidator('NotEmpty')->setMessage('Bitte geben Sie Ihren Nachnamen an.');
        $lastname->getValidator('Alpha')->setMessage('Das Feld darf nur Buchstaben enthalten.');
    	$lastname->getValidator('StringLength')->setMessage('Der Nachname muss zwischen 2 und 50 Zeichen lang sein.');
    	 
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('Registrieren')
    	->setDecorators($this->buttonDecorators);
    	
    	$this->addElements(array($email, $password, $confirm_password, $title, $name, $lastname, $submit));
    }

    public function loadDefaultDecorators()
    {
    	$this->setDecorators(array(
    			'FormElements',
    			array('HtmlTag', array('tag' => 'table')),
    			'Form',
    	));
    }
}

