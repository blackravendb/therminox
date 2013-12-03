<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
    	$this->setName('login')
    		 ->setMethod('post')
    		 ->setAction('/account/login')
    	 	 ->setAttrib('id', 'login');
    	
    	$email = new Zend_Form_Element_Text('email');
    	$email->setLabel('Benutzername')
    		  ->setRequired(true);
    	
    	$password = new Zend_Form_Element_Password('password');
    	$password->setLabel('Passwort')
    			 ->setRequired(true);
    	
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('Login');
    	
    	$this->addElements(array($email, $password, $submit));
    }


}

