<?php

class Application_Form_Kontakt extends App_Form
{
	public function init()
	{
		$this->setMethod('post')
		->setAction('/startseite/kontakt')
		->setAttrib('id', 'kontakt');

		 
		$email = new Zend_Form_Element_Text('kontakt_email');
		$email->setRequired(true)
		->setLabel('Ihre E-mail Adresse')
		->setDecorators($this->elementDecorators)
		->addFilter('StringTrim')
		->addValidator('EmailAddress')
		->addErrorMessage('Bitte geben Sie Ihre E-mail Adresse an.');

		$text = new Zend_Form_Element_Textarea('kontakt_text');
		$text->setRequired(true)
		->setLabel('Ihr Text')
		->setDecorators($this->elementDecorators)
		->addFilter('StringTrim')
		->addFilter('StripTags')
		->setAttrib('cols', '40')
		->setAttrib('rows', '4')
		->setAttrib('maxlength', '1000')
		->setValidators(array(
    		array('NotEmpty', true),
            array('StringLength', true, array('max' => 1000))
        ));
		$text->getValidator('NotEmpty')->setMessage('Bitte geben Sie Ihre Nachricht an.');
    	$text->getValidator('StringLength')->setMessage('Ihre Nachricht darf maximal 1000 Zeichen enhalten.');
		 
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Abschicken')
		->setDecorators($this->buttonDecorators);
		 
		$this->addElements(array($email, $text, $submit));
	}
}