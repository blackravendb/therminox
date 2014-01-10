<?php
class Application_Form_WtBearbeiten extends Zend_Form {
	
	private $dbdata = null;
	
	public function init(){
		$anschluesse = array();
		$i = 0;
	}
	
	public function setDbdata($data_object){
		$this->dbdata = $data_object;
	}
	
	public function startform(){
		
		$val = new Zend_Validate_Digits('1234567890');
		
		$wtmapper = new Application_Model_WaermetauscherMapper();
        $einsatzgebiete = $wtmapper->getEinsatzgebietListe();
        $anschluesse = $wtmapper->getAnschlussListe();
		
		$name = new Zend_Form_Element_Text('Artikelname');
		$name->setLabel('Artikelname:')
		->setValue($this->dbdata->getModel())
		->addFilter('StripTags')
		->addFilter('StringTrim');
		 
		$temp = new Zend_Form_Element_Text('Temperatur');
		$temp->setLabel('Temperatur:')
		->addValidator($val)
		->setValue($this->dbdata->getTemperatur())
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Bitte für Temperatur, Höhe und Breite nur Zahlen eingeben!');
		
		$einsatzgbt = new Zend_Form_Element_Select('Einsatzgebiet');
		$einsatzgbt->setLabel('Einsatzgebiet:');
		foreach($einsatzgebiete as $value){
        	$einsatzgbt->addMultiOption((string)$value, (string)$value); //funktioniert!
        }
		$einsatzgbt->addFilter('StripTags')
					->addFilter('StringTrim');
		foreach($this->dbdata->getWaermetauscherEinsatzgebiet() as $gbt){
			$einsatzgebiet = $gbt->getEinsatzgebiet();
			$einsatzgbt->setValue($einsatzgebiet);
		}
		
		$maxHeight = new Zend_Form_Element_Text('Hoehe');
		$maxHeight->setLabel('Maximale Höhe:')
		->addValidator($val)
		->setValue($this->dbdata->getHoehe())
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Bitte für Temperatur, Höhe und Breite nur Zahlen eingeben!');

		$maxWidth = new Zend_Form_Element_Text('Breite');
		$maxWidth->setLabel('Maximale Breite:')
		->addValidator($val)
		->setValue($this->dbdata->getBreite())
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Bitte für Temperatur, Höhe und Breite nur Zahlen eingeben!');

		$anschluss = new Zend_Form_Element_MultiCheckbox('Anschluss');
		$anschluss->setLabel('Anschlüsse:');
		foreach($anschluesse as $value){
       		$anschluss->addMultiOption((string)$value, (string)$value);
       	}
		foreach($this->dbdata->getWaermetauscherAnschluss() as $ans){
    					$anschluesse[] = $ans->getAnschluss();
  						}
		$anschluss->setValue($anschluesse);
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Artikel ändern');
		 
		$this->addElements(array($name, $temp, $einsatzgbt, $maxHeight, $maxWidth, $anschluss, $submit));
	}
}