<?php

class Application_Form_WtErstellen extends App_Form {

	public function __construct($options = null)
	{
		parent::__construct($options);
		 
		$tempVal = new Zend_Validate_Between(array('min' => 155, 'max' => 195));
		$heightVal = new Zend_Validate_Between(array('min' => 170, 'max' => 1100));
		$widthVal = new Zend_Validate_Between(array('min' => 70, 'max' => 400));
		$lengthVal = new Zend_Validate_Between(array('min' => 20, 'max' => 500));

		$name = new Zend_Form_Element_Text('Model');
		$name->setLabel('Artikelmodell:')
		->addFilter('StripTags')
		->addFilter('StringTrim');
		 		 		 	
		$temp = new Zend_Form_Element_Text('Temperatur');
		$temp->setLabel('Temperatur in °C:')
		->addFilter('StripTags')
		->addFilter('StringTrim');
		
		$pressure = new Zend_Form_Element_Text('Betriebsdruck');
		$pressure->setLabel('Betriebsdruck in bar:')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$einsatzgbt = new Zend_Form_Element_MultiCheckbox('Einsatzgebiet');
		$einsatzgbt->setLabel('Einsatzgebiete:')
		->addFilter('StripTags')
		->addFilter('StringTrim');
		$db_mapper = new Application_Model_WaermetauscherMapper();
		$gebiete = $db_mapper->getEinsatzgebietListe();
		foreach ($gebiete as $gebiet){
		$einsatzgbt->addMultiOption("$gebiet", "$gebiet");
		}
		
		
		 
		$anschluss = new Zend_Form_Element_MultiCheckbox('Anschluss', array(
				'multiOptions' => array(
						'3/8" IG' => '3/8" IG',
						'1/2" AG' => '1/2" AG',
						'3/4" AG' => '3/4" AG'
				)
		));
		$anschluss->setLabel('Anschlüsse:');
		
		$material = new Zend_Form_Element_Select('Stutzenmaterial');
		$material->setLabel('Stutzenmaterial:')
		->addFilter('StripTags')
		->addFilter('StringTrim');
		$materialien = $db_mapper->getStutzenmaterialListe();
		foreach ($materialien as $einmaterial){
			$material->addMultiOption("$einmaterial", $einmaterial);
		}
		
		
	
		$maxHeight = new Zend_Form_Element_Text('Hoehe');
		$maxHeight->setLabel('Maximale Höhe in cm:')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$maxWidth = new Zend_Form_Element_Text('Breite');
		$maxWidth->setLabel('Maximale Breite in cm:')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Artikel erzeugen');
		 
		$this->addElements(array($name,$temp, $pressure, $einsatzgbt, $anschluss, $maxHeight, $maxWidth, $material, $submit));
	}
}