<?php

class Application_Form_Password extends App_Form
{    
    public function init()
    {
    	$this->setMethod('post')
    	->setAction('/account/password')
    	->setAttrib('id', 'password');
    	 
    	$oldPassword= new Zend_Form_Element_Password('old_password');
    	$oldPassword->setRequired(true)
    	->setLabel('Altes Passwort')
    	->setDecorators($this->elementDecorators)
    	->setValidators(array(
    			array('NotEmpty', true),
    			array('StringLength', true, array('min' => 6, 'max' => 50))
    	));
    	$oldPassword->getValidator('NotEmpty')->setMessage('Das Password darf nicht leer sein.');
    	$oldPassword->getValidator('StringLength')->setMessage('Das Password muss mind. 6 Zeichen haben.');
    	
    	$newPassword = new Zend_Form_Element_Password('new_password');
    	$newPassword->setRequired(true)
    	->setLabel('Neues Passwort')
    	->setDecorators($this->elementDecorators)
    	->setValidators(array(
    			array('NotEmpty', true),
    			array('StringLength', true, array('min' => 6, 'max' => 50))
    	));
    	$newPassword->getValidator('NotEmpty')->setMessage('Das Password darf nicht leer sein.');
    	$newPassword->getValidator('StringLength')->setMessage('Das Password muss mind. 6 Zeichen haben.');
    	
    	$confirm_password = new Zend_Form_Element_Password('confirm_password');
    	$confirm_password->setRequired(true)
    	->setLabel('Passwort bestätigen')
    	->setDecorators($this->elementDecorators)
    	->addErrorMessage('Die Passwörter stimmen nicht überein.')
    	->addValidator('Identical', false, array('token' => 'new_password'));
    	 
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('Speichern')
    	->setDecorators($this->buttonDecorators);
    	 
    	$this->addElements(array($oldPassword, $newPassword, $confirm_password, $submit));
    }
}

