<?php

class Application_Form_Profile extends App_Form
{
	public function init()
    {
    	$this->setMethod('post')
    	->setAction('/account/profile')
    	->setAttrib('id', 'profile');
   
    	$email = new Zend_Form_Element_Text('email');
    	$email->setAttrib('readonly', 'true')
    	->setLabel('Email-Adresse')
    	->setDecorators($this->elementDecorators);
    	 
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
    	->addFilter('StringTrim')
    	->setValidators(array(
    		array('NotEmpty', true),
            array('Alpha', true, array('allowWhiteSpace' => true)),
            array('StringLength', true, array('min' => 1, 'max' => 100))
        ));
    	$name->getValidator('NotEmpty')->setMessage('Bitte geben Sie Ihren Vornamen an.');
    	$name->getValidator('Alpha')->setMessage('Das Feld darf nur Buchstaben enthalten.');
    	$name->getValidator('StringLength')->setMessage('Der Vorname muss zwischen 1 und 100 Zeichen lang sein.');
    	
    	$lastname = new Zend_Form_Element_Text('lastname');
    	$lastname->setRequired(true)
    	->setLabel('Nachname')
    	->setDecorators($this->elementDecorators)
    	->addFilter('StringTrim')
    	->setValidators(array(
    		array('NotEmpty', true),
            array('Alpha', true, array('allowWhiteSpace' => true)),
            array('StringLength', true, array('min' => 1, 'max' => 100))
        ));
    	$lastname->getValidator('NotEmpty')->setMessage('Bitte geben Sie Ihren Nachnamen an.');
        $lastname->getValidator('Alpha')->setMessage('Das Feld darf nur Buchstaben enthalten.');
    	$lastname->getValidator('StringLength')->setMessage('Der Nachname muss zwischen 1 und 100 Zeichen lang sein.');
    	
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('Ändern')
    	->setDecorators($this->buttonDecorators);
    	
    	$this->addElements(array($email, $title, $name, $lastname, $submit));
    }
}

