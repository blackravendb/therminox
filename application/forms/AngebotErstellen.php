<?php
class Application_Form_AngebotErstellen extends App_Form {
	
	public function __construct($options = null) {
		
		parent::__construct ( $options );
		
		$extraInfo = new Zend_Form_Element_Textarea('extraInfo');
		$extraInfo
		->setAttrib('required','required')
		->addFilter('StripTags')
		->addFilter('StringTrim');
		
		$addMore = new Zend_Form_Element_Submit('addMore');
		$addMore->setLabel('Weitere Artikel zum Angebot hinzufügen');
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Angebot absenden');
		
		$this->addElements(array($extraInfo, $addMore, $submit));
		$this->addElement('hidden', 'return', array(
				'value' => Zend_Controller_Front::getInstance()->getRequest()->getRequestUri(),
		));
	}
	
}