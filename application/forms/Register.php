<?php

class Application_Form_Register extends App_Form
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
    	->setAction('/account/register')
    	->setAttrib('id', 'register');
   
    	$email = new Zend_Form_Element_Text('email');
    	$email->setRequired(true)
    	->setLabel('Email-Adresse*')
    	->setDecorators($this->elementDecorators)
    	->addFilter('StringTrim')
    	->setValidators(array(
    		array('NotEmpty', true),
            array('EmailAddress', true)
        ))
    	->addErrorMessage('Bitte geben Sie eine gültige Email-Adresse an.');
    	 
    	$password = new Zend_Form_Element_Password('password');
    	$password->setRequired(true)
    	->setLabel('Passwort*')
    	->setDecorators($this->elementDecorators)
    	->setValidators(array(
    			array('NotEmpty', true),
    			array('StringLength', true, array('min' => 6, 'max' => 50))
    	));
    	$password->getValidator('NotEmpty')->setMessage('Das Password darf nicht leer sein.');
    	$password->getValidator('StringLength')->setMessage('Das Password muss mind. 6 Zeichen haben.');

    	
    	$confirm_password = new Zend_Form_Element_Password('confirm_password');
    	$confirm_password->setRequired(true)
    	->setLabel('Passwort bestätigen*')
    	->setDecorators($this->elementDecorators)
    	->addErrorMessage('Die Passwörter stimmen nicht überein.')
    	->addValidator('Identical', false, array('token' => 'password'));
    	
    	$title = new Zend_Form_Element_Select('title');
    	$title->setLabel('Anrede*')
    	->setDecorators($this->elementDecorators)
    	->addMultiOptions(array(
    			'herr' => 'Herr',
    			'frau' => 'Frau'
    	));
    	
    	$company = new Zend_Form_Element_Text('company');
    	$company->setLabel('Firma')
    	->setDecorators($this->elementDecorators)
    	->addFilter('StringTrim')
    	->setValidators(array(
    			array('Alnum', true, array('allowWhiteSpace' => true)),
    			array('StringLength', true, array('min' => 0, 'max' => 50))
    	));
    	$company->getValidator('Alnum')->setMessage('Das Feld darf nur Buchstaben enthalten.');
    	$company->getValidator('StringLength')->setMessage('Die Firma darf höchstens 50 Zeichen haben.');
    	
    	$name = new Zend_Form_Element_Text('name');
    	$name->setRequired(true)
    	->setLabel('Vorname*')
    	->setDecorators($this->elementDecorators)
    	->addFilter('StringTrim')
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
    	->setLabel('Nachname*')
    	->setDecorators($this->elementDecorators)
    	->addFilter('StringTrim')
    	->setValidators(array(
    		array('NotEmpty', true),
            array('Alpha', true, array('allowWhiteSpace' => true)),
            array('StringLength', true, array('min' => 2, 'max' => 50))
        ));
    	$lastname->getValidator('NotEmpty')->setMessage('Bitte geben Sie Ihren Nachnamen an.');
        $lastname->getValidator('Alpha')->setMessage('Das Feld darf nur Buchstaben enthalten.');
    	$lastname->getValidator('StringLength')->setMessage('Der Nachname muss zwischen 2 und 50 Zeichen lang sein.');
    	
    	$street = new Zend_Form_Element_Text('street');
    	$street->setRequired(true)
    	->setLabel('Straße*')
    	->setDecorators($this->elementDecorators)
    	->addFilter('StringTrim')
    	->setValidators(array(
    			array('NotEmpty', true),
    			array('StringLength', true, array('max' => 50))
    	));
    	$street->getValidator('NotEmpty')->setMessage('Bitte geben Sie Ihre Straße an.');
    	$street->getValidator('StringLength')->setMessage('Die Straße darf höchstens 50 Zeichen lang sein.');
    	
    	$address = new Zend_Form_Element_Text('address');
    	$address->setLabel('Adresszusatz')
    	->setDecorators($this->elementDecorators)
    	->addFilter('StringTrim')
    	->setValidators(array(
    			array('StringLength', false, array('min' => 0, 'max' => 30))
    	));
    	$address->getValidator('StringLength')->setMessage('Der Adresszusatz darf höchstens 30 Zeichen haben.');
    	
    	$locale = Zend_Registry::getInstance()->get("Zend_Locale"); 
    	$countries = ($locale->getTranslationList('Territory', $locale->getLanguage(), 2));
    	asort($countries, SORT_LOCALE_STRING); 
    	$country = new Zend_Form_Element_Select('country', array(
    			'decorators' => $this->elementDecorators,
    			'label' => _('Land*'),
    			'required' => true,
    			'filters' => array(
    					'StringTrim'
    			),
    			'class' => 'input-select'
    	));
    	$country->addMultiOptions($countries)
    	->setValue($locale->getRegion());


    	$myValidator = new App_Validate_MyPostCode();
    	$plz = new Zend_Form_Element_Text('plz');
    	$plz->setRequired(true)
    	->setLabel('Postleitzahl*')
    	->setDecorators($this->elementDecorators)
    	->addFilter('StringTrim')
    	->addValidator($myValidator, false)
    	->addErrorMessage('Bitte geben Sie eine gültige Postleitzahl für das ausgewählte Land an.');
    	 
    	
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('Registrieren')
    	->setDecorators($this->buttonDecorators);
    	
    	$this->addElements(array($email, $password, $confirm_password, $company, $title, $name, $lastname, $street, $address, $country, $plz, $submit));
	
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

