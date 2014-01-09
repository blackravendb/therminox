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
		->setValue($this->dbdata->getTemperatur())
		->addFilter('StripTags')
		->addFilter('StringTrim');
		
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
		 
		$anschluss = new Zend_Form_Element_MultiCheckbox('Anschluss');
		$anschluss->setLabel('Anschlüsse:');
		foreach($anschluesse as $value){
       		$anschluss->addMultiOption((string)$value, (string)$value);
       	}
		foreach($this->dbdata->getWaermetauscherAnschluss() as $ans){
    					$anschluesse[] = $ans->getAnschluss();
  						}
		$anschluss->setValue($anschluesse);
		
		$maxHeight = new Zend_Form_Element_Text('Hoehe');
		$maxHeight->setLabel('Maximale Höhe:')
		->setValue($this->dbdata->getHoehe())
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$maxWidth = new Zend_Form_Element_Text('Breite');
		$maxWidth->setLabel('Maximale Breite:')
		->setValue($this->dbdata->getBreite())
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Artikel ändern');
		 
		$this->addElements(array($name, $temp, $einsatzgbt, $anschluss, $maxHeight, $maxWidth, $submit));
	}
}