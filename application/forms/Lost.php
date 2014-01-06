<?php

class Application_Form_Lost extends App_Form
{    
    public function init()
    {
    	$this->setMethod('post')
    	->setAction('/account/lost')
    	->setAttrib('id', 'lost');
    	 
    	$email = new Zend_Form_Element_Text('email');
    	$email->setRequired(true)
    	->setLabel('E-mail')
    	->setDecorators($this->elementDecorators)
    	->addFilter('StringTrim')
    	->addValidator('EmailAddress')
    	->addErrorMessage('Bitte geben Sie Ihre E-mail Adresse an.');
    	 
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('Passwort anfordern')
    	->setDecorators($this->buttonDecorators);
    	 
    	$this->addElements(array($email, $submit));
    }
}

