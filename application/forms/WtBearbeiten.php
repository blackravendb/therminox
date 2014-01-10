<?php
class Application_Form_WtBearbeiten extends Zend_Form {
	
	private $dbdata = null;
	
	public function init(){
		$checkedAnschluesse = array();
		$checkedEinsatzgebiete = array();
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
		
		$height = new Zend_Form_Element_Text('Hoehe');
		$height->setLabel('Höhe:')
		->addValidator($val)
		->setValue($this->dbdata->getHoehe())
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Bitte für Temperatur, Höhe und Breite nur Zahlen eingeben!');

		$width = new Zend_Form_Element_Text('Breite');
		$width->setLabel('Breite:')
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
    					$checkedAnschluesse[] = $ans->getAnschluss();
  						}
		$anschluss->setValue($checkedAnschluesse);
		
		$einsatzgbt = new Zend_Form_Element_MultiCheckbox('Einsatzgebiete');
		$einsatzgbt->setLabel('Einsatzgebiete:');
		foreach($einsatzgebiete as $value){
        	$einsatzgbt->addMultiOption((string)$value, (string)$value);
        }
        foreach($this->dbdata->getWaermetauscherEinsatzgebiet() as $value){
        	$checkedEinsatzgebiete[] = $value->getEinsatzgebiet();
        }
		$einsatzgbt->setValue($checkedEinsatzgebiete);
					
		$submit = new Zend_Form_Element_Submit('artikelÄndern');
		$submit->setLabel('Artikel ändern');
		 
		$this->addElements(array($name, $temp, $height, $width, $anschluss, $einsatzgbt, $submit));
	}
}