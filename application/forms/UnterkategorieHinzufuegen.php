<?php
class Application_Form_UnterkategorieHinzufuegen extends Zend_Form {
	
	public function startform(){
		
		$val1 = new Zend_Validate_Digits('1234567890');
		
		$platten = new Zend_Form_Element_Text('AnzahlPlatten');
		$platten->setLabel('Anzahl Platten:')
		->addValidator($val1)
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Eingaben überprüfen!');
		
		$laenge = new Zend_Form_Element_Text('Laenge');
		$laenge->setLabel('Länge (mm):')
		->addValidator($val1)
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Eingaben überprüfen!');
		
		$leergewicht = new Zend_Form_Element_Text('Leergewicht');
		$leergewicht->setLabel('Leergewicht (kg):')
		->addValidator('Float')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Eingaben überprüfen!');
		
		$flaeche = new Zend_Form_Element_Text('Flaeche');
		$flaeche->setLabel('Fläche (m²):')
		->addValidator('Float')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Eingaben überprüfen!');
			
		$submit = new Zend_Form_Element_Submit('unterkategorieHinzufuegen');
		$submit->setLabel('Unterkategorie ändern');
		
		$this->addElements(array($platten, $laenge, $leergewicht, $flaeche, $submit));
	}
}