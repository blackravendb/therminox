<?php
class Application_Form_UnterkategorienBearbeiten extends Zend_Form {
	
	private $dbdata = null;
	
	public function init(){

	}
	
	public function setDbdata($data_object){
		$this->dbdata = $data_object;
	}
	
	public function startform(){
		
		$val1 = new Zend_Validate_Digits('1234567890');
		$val2 = new Zend_Validate_Digits('123456789.');
		
		$name = new Zend_Form_Element_Text('UnterkategorieName');
		$name->setLabel('Name:')
		->setValue($this->dbdata->getModel()) //TODO Dennis fragen!!!
		->addFilter('StripTags')
		->addFilter('StringTrim');
		 
		$platten = new Zend_Form_Element_Text('AnzahlPlatten');
		$platten->setLabel('Anzahl Platten:')
		->addValidator($val1)
		->setValue($this->dbdata->getPlatten())
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Eingaben überprüfen!');
		
		$laenge = new Zend_Form_Element_Text('Laenge');
		$laenge->setLabel('Länge (mm):')
		->addValidator($val1)
		->setValue($this->dbdata->getLaenge())
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Eingaben überprüfen!');

		$leergewicht = new Zend_Form_Element_Text('Leergewicht');
		$leergewicht->setLabel('Leergewicht (kg):')
		->addValidator($val2)
		->setValue($this->dbdata->getLeergewicht())
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Eingaben überprüfen!');

		$flaeche = new Zend_Form_Element_MultiCheckbox('Flaeche');
		$flaeche->setLabel('Fläche (m²):')
		->addValidator($val2)
		->setValue($this->dbdata->getFlaeche())
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Eingaben überprüfen!');
					
		$submit = new Zend_Form_Element_Submit('unterkategorieAendern');
		$submit->setLabel('Unterkategorie ändern');
		 
		$this->addElements(array($name, $platten, $laenge, $leergewicht, $flaeche, $submit));
	}
}