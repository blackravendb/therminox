<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post')
    		 ->setAction('/account/login')
    	 	 ->setAttrib('id', 'login');

    	
    	$email = new Zend_Form_Element_Text('email');
    	$email->setRequired(true)
    		  ->setLabel('Benutzername')
    		  ->setDecorators(array('ViewHelper', 'Label', 'Errors'))
    		  ->addErrorMessage('Bitte geben Sie Ihren Benutzernamen an.');
 
    	$password = new Zend_Form_Element_Password('password');
    	$password->setRequired(true)
    			 ->setLabel('Passwort')
    			 ->setDecorators(array('ViewHelper', 'Label', 'Errors'))
    			 ->addErrorMessage('Bitte geben Sie Ihr Passwort an.');
    	
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('Anmelden')
    		   ->setDecorators(array('ViewHelper'));
    		     	
    	$this->setDecorators( array( array('ViewScript', array('viewScript' => '_form_login.phtml'))));
    	$this->addElements(array($email, $password, $submit));
    }


}

