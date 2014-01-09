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
		
		/*
		$tempVal = new Zend_Validate_Between(array('min' => 155, 'max' => 195));
		$heightVal = new Zend_Validate_Between(array('min' => 170, 'max' => 1100));
		$widthVal = new Zend_Validate_Between(array('min' => 70, 'max' => 400));
		$lengthVal = new Zend_Validate_Between(array('min' => 20, 'max' => 500));
		*/
		
		if(empty($this->dbdata)){
			echo "Variable leer";
		}
		echo $this->dbdata->getModel();
		
		$name = new Zend_Form_Element_Text('Artikelname');
		$name->setLabel('Artikelname:')
		->setValue($this->dbdata->getModel())
		->addFilter('StripTags')
		->addFilter('StringTrim');
		
		/*
		$code = new Zend_Form_Element_Text('Artikelcode');
		$code->setLabel('Artikelkürzel:')
		->setValue($produkt)
		->addFilter('StripTags')
		->addFilter('StringTrim');
		 */
		
		//TODO Artikelbeschreibung Datenbank MEthoden?!?!?
		/*
		$descr = new Zend_Form_Element_Textarea('Artikelbeschreibung');
		$descr->setLabel('Beschreibung:')
		->addFilter('StripTags')
		->addFilter('StringTrim');
		*/
		 
		$temp = new Zend_Form_Element_Text('Temperatur');
		$temp->setLabel('Temperatur:')
		->setValue($this->dbdata->getTemperatur())
		->addFilter('StripTags')
		->addFilter('StringTrim');
		
		$einsatzgbt = new Zend_Form_Element_Select('Einsatzgebiet');
		$einsatzgbt->setLabel('Einsatzgebiet:')
		->addMultiOption('Fernwärme', 'Fernwärme')
		->addMultiOption('Solaranlage', 'Solaranlage')
		->addMultiOption('Erdbohrung', 'Erdbohrung')
		->addMultiOption('Umrüstung von PKW`s auf Rapsöl', 'Umrüstung von PKW`s auf Rapsöl')
		->addMultiOption('Umrüstung großerer Nutzfahrzeuge auf Rapsöl', 'Umrüstung großerer Nutzfahrzeuge auf Rapsöl')
		->addFilter('StripTags')
		->addFilter('StringTrim');
		foreach($this->dbdata->getWaermetauscherEinsatzgebiet() as $gbt){
			$einsatzgebiet = $gbt->getEinsatzgebiet();
			$einsatzgbt->setValue($einsatzgebiet);
		}
		 
		$anschluss = new Zend_Form_Element_MultiCheckbox('Anschluss', array(
				'multiOptions' => array(
						'3/8" IG' => '3/8" IG',
						'1/2" AG' => '1/2" AG',
						'3/4" AG' => '3/4" AG'
				)
		));
		$anschluss->setLabel('Anschlüsse:');
		foreach($this->dbdata->getWaermetauscherAnschluss() as $ans){
    					$anschluesse[] = $ans->getAnschluss();
  						}
  		$anschluss->setValue($anschluesse[1]);
		$anschluss->setValue($anschluesse);
		
		foreach($anschluesse as $value){ //TODO löschen
			echo $value;	
			echo count($anschluesse);
		}
		
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