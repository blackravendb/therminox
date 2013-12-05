<?php

class Application_Form_Login extends Zend_Form
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
    		 ->setAction('/account/login')
    	 	 ->setAttrib('id', 'login');

    	
    	$email = new Zend_Form_Element_Text('email');
    	$email->setRequired(true)
    		  ->setLabel('Benutzername')
    		  ->setDecorators($this->elementDecorators)
    		  ->addErrorMessage('Bitte geben Sie Ihren Benutzernamen an.');
 
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

    public function loadDefaultDecorators()
    {
    	$this->setDecorators(array(
    			'FormElements',
    			array('HtmlTag', array('tag' => 'table')),
    			'Form',
    	));
    }

}

