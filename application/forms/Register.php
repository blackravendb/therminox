<?php

class Application_Form_Register extends App_Form
{
	public function init()
    {
    	$this->setMethod('post')
    	->setAction('/account/register')
    	->setAttrib('id', 'register');
   
    	$email = new Zend_Form_Element_Text('email');
    	$email->setRequired(true)
    	->setLabel('Email-Adresse')
    	->setDecorators($this->elementDecorators)
    	->addFilter('StringTrim')
    	->setValidators(array(
    		array('NotEmpty', true),
            array('EmailAddress', true)
        ))
    	->addErrorMessage('Bitte geben Sie eine gültige Email-Adresse an.');
    	 
    	$password = new Zend_Form_Element_Password('password');
    	$password->setRequired(true)
    	->setLabel('Passwort')
    	->setDecorators($this->elementDecorators)
    	->setValidators(array(
    			array('NotEmpty', true),
    			array('StringLength', true, array('min' => 6, 'max' => 50))
    	));
    	$password->getValidator('NotEmpty')->setMessage('Das Passwort darf nicht leer sein.');
    	$password->getValidator('StringLength')->setMessage('Das Passwort muss mind. 6 Zeichen haben.');

    	
    	$confirm_password = new Zend_Form_Element_Password('confirm_password');
    	$confirm_password->setRequired(true)
    	->setLabel('Passwort bestätigen')
    	->setDecorators($this->elementDecorators)
    	->addErrorMessage('Die Passwörter stimmen nicht überein.')
    	->addValidator('Identical', false, array('token' => 'password'));
    	
    	$title = new Zend_Form_Element_Select('title');
    	$title->setLabel('Anrede')
    	->setDecorators($this->elementDecorators)
    	->addMultiOptions(array(
    			'Herr' => 'Herr',
    			'Frau' => 'Frau'
    	));
    	$title->addErrorMessage('Bitte wählen Sie eine gültige Ausrede.');
    	
    	$company = new Zend_Form_Element_Text('company');
    	$company->setRequired(true)
    	->setLabel('Firma')
    	->setDecorators($this->elementDecorators)
    	->addFilter('StringTrim')
    	->setValidators(array(
    			array('NotEmpty', true),
    			array('Alnum', true, array('allowWhiteSpace' => true)),
    			array('StringLength', true, array('min' => 1, 'max' => 100))
    	));
    	$company->getValidator('NotEmpty')->setMessage('Bitte geben Sie Ihre Firma an.');
    	$company->getValidator('Alnum')->setMessage('Das Feld darf nur Buchstaben enthalten.');
    	$company->getValidator('StringLength')->setMessage('Die Firma darf höchstens 100 Zeichen haben.');
    	
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
    	$name->getValidator('StringLength')->setMessage('Der Vorname muss zwischen 1 und 10 Zeichen lang sein.');
    	
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
    	
    	$street = new Zend_Form_Element_Text('street');
    	$street->setRequired(true)
    	->setLabel('Straße')
    	->setDecorators($this->elementDecorators)
    	->addFilter('StringTrim')
    	->addFilter('StripTags')
    	->setValidators(array(
    			array('NotEmpty', true),
    			array('StringLength', true, array('min' => 1, 'max' => 100))
    	));
    	$street->getValidator('NotEmpty')->setMessage('Bitte geben Sie Ihre Straße an.');
    	$street->getValidator('StringLength')->setMessage('Die Straße muss zwischen 1 und 100 Zeichen lang sein.');   	
    	
    	$locale = Zend_Registry::get("Zend_Locale"); 
    	$countries = $locale->getTranslationList('Territory', $locale->getLanguage(), 2);
    	unset($countries['ZZ']);
    	asort($countries, SORT_LOCALE_STRING); 
    	$country = new Zend_Form_Element_Select('country', array(
    			'decorators' => $this->elementDecorators,
    			'label' => 'Land',
    			'required' => true,
    			'filters' => array(
    					'StringTrim'
    			),
    			'class' => 'input-select'
    	));	
    	$country->addMultiOptions($countries)
    	->setValue($locale->getRegion());
    	$country->addErrorMessage('Ungültiges Land.');

    	$myValidator = new App_Validate_MyPostCode();
    	$plz = new Zend_Form_Element_Text('plz');
    	$plz->setRequired(true)
    	->setLabel('Postleitzahl')
    	->setDecorators($this->elementDecorators)
    	->addFilter('StringTrim')
    	->addFilter('StripTags')
    	->addValidator($myValidator, false)
    	->addErrorMessage('Bitte geben Sie eine gültige Postleitzahl für das ausgewählte Land an.');
    	
    	$town = new Zend_Form_Element_Text('town');
    	$town->setRequired(true)
    	->setLabel('Ort')
    	->setDecorators($this->elementDecorators)
    	->addFilter('StringTrim')
    	->addFilter('StripTags')
    	->setValidators(array(
    			array('NotEmpty', true),
    			array('StringLength', true, array('max' => 100))
    	));
    	$town->getValidator('NotEmpty')->setMessage('Bitte geben Sie Ihren Wohnort an.');
    	$town->getValidator('StringLength')->setMessage('Der Ort darf höchstens 100 Zeichen lang sein.');
    	 
    	
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('Registrieren')
    	->setDecorators($this->buttonDecorators);
    	
    	$this->addElements(array($email, $password, $confirm_password, $company, $title, $name, $lastname, $street, $country, $plz, $town, $submit));
    }
}