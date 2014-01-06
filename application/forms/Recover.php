<?php

class Application_Form_Recover extends App_Form
{   
	private $_key;
	
	public function __construct($key, $options=null)
	{
		$this->_key = $key;
		parent::__construct($options); 
	}
	
    public function init()
    {
    	$this->setMethod('post')
    	->setAction('/account/recover/key/' . $this->_key)
    	->setAttrib('id', 'recover');
    	
    	$newPassword = new Zend_Form_Element_Password('password');
    	$newPassword->setRequired(true)
    	->setLabel('Neues Passwort')
    	->setDecorators($this->elementDecorators)
    	->setValidators(array(
    			array('NotEmpty', true),
    			array('StringLength', true, array('min' => 6, 'max' => 50))
    	));
    	$newPassword->getValidator('NotEmpty')->setMessage('Das Password darf nicht leer sein.');
    	$newPassword->getValidator('StringLength')->setMessage('Das Password muss mind. 6 Zeichen haben.');
    	
    	$confirmPassword = new Zend_Form_Element_Password('confirm_password');
    	$confirmPassword->setRequired(true)
    	->setLabel('Passwort bestätigen')
    	->setDecorators($this->elementDecorators)
    	->addErrorMessage('Die Passwörter stimmen nicht überein.')
    	->addValidator('Identical', false, array('token' => 'password'));
    	 
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('Speichern')
    	->setDecorators($this->buttonDecorators);
    	 
    	$this->addElements(array($newPassword, $confirmPassword, $submit));
    }

}

