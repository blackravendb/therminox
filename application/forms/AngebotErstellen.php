<?php
class Application_Form_AngebotErstellen extends App_Form {
	
	public function __construct($options = null) {
		
		parent::__construct ( $options );
		
		$userdata = $this->_userinfo;
		$articledata = $this->_articleinfo;
		$articlename = 'Testartikel';
		
		$infotext = "Sehr geehrte Damen und Herren,
				Ich möchte ein Angebot für den Artikel ".$articlename."einholen.
				Weiter würden mich folgende Informationen interessieren:";
		
		$extraInfo = new Zend_Form_Element_Textarea('extraInfo');
		$extraInfo->setLabel('Weitere Wünsche:')
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->setValue($infotext);
		
		$addMore = new Zend_Form_Element_Button('addMore');
		$addMore->setLabel('Weitere Artikel zum Angebot hinzufügen');
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Angebot absenden');
		
		$this->addElements(array($extraInfo, $addMore,$submit));
	}
	
}