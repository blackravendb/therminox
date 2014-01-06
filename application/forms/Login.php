<?php

class Application_Form_Login extends App_Form
{
    public function init()
    {
    	$this->setMethod('post')
    		 ->setAction('/account/login')
    	 	 ->setAttrib('id', 'login');

    	
    	$email = new Zend_Form_Element_Text('email');
    	$email->setRequired(true)
    		  ->setLabel('E-mail Adresse')
    		  ->setDecorators($this->elementDecorators)
    		  ->addFilter('StringTrim')
    		  ->addValidator('EmailAddress')
    		  ->addErrorMessage('Bitte geben Sie Ihre E-mail Adresse an.');
 
    	$password = new Zend_Form_Element_Password('password');
    	$password->setRequired(true)
    			 ->setLabel('Passwort')
    			 ->setDecorators($this->elementDecorators)
    			 ->addErrorMessage('Bitte geben Sie Ihr Passwort an.');
    	
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('Anmelden')
    		   ->setDecorators($this->buttonDecorators);
    	 	
    	$this->addElements(array($email, $password, $submit));
    }
}