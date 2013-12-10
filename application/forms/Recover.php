<?php

class Application_Form_Recover extends Zend_Form
{
    private $elementDecorators = array(
    		'ViewHelper',
    		array(
    				array('data' => 'HtmlTag'),
    				array('tag' => 'td')
    		),
    		array(
    				array('openerror' => 'HtmlTag'),
    				array('tag' => 'td', 'openOnly' => true, 'placement' => Zend_Form_Decorator_Abstract::APPEND)
    		),
    		'Errors',
    		array(
    				array('closeerror' => 'HtmlTag'),
    				array('tag' => 'td', 'closeOnly' => true, 'placement' => Zend_Form_Decorator_Abstract::APPEND)
    		),
    		array('Label',
    				array('tag' => 'td')
    		),
    		array(
    				array('row' => 'HtmlTag'),
    				array('tag' => 'tr')
    		)
    );
    
    private $buttonDecorators = array(
    		'ViewHelper',
    		array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
    		array(array('label' => 'HtmlTag'), array('tag' => 'td', 'placement' => 'prepend')),
    		array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
    );
    
    public function init()
    {
    	$this->setMethod('post')
    	->setAction('/account/recover')
    	->setAttrib('id', 'recover');
    	 
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
    
    public function loadDefaultDecorators()
    {
    	$this->setDecorators(array(
    			'FormElements',
    			array('HtmlTag', array('tag' => 'table')),
    			'Form',
    	));
    }

}

