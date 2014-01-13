<?php
class Application_Form_WtErstellen extends App_Form {
	public function __construct($options = null) {
		parent::__construct ( $options );
		
		$tempVal = new Zend_Validate_Between ( array (
				'min' => 155,
				'max' => 195 
		) );
		$heightVal = new Zend_Validate_Between ( array (
				'min' => 170,
				'max' => 1100 
		) );
		$widthVal = new Zend_Validate_Between ( array (
				'min' => 70,
				'max' => 400 
		) );
		$lengthVal = new Zend_Validate_Between ( array (
				'min' => 20,
				'max' => 500 
		) );
		
		$name = new Zend_Form_Element_Text ( 'Model' );
		$name->setLabel ( 'Artikelmodell:' )->addFilter ( 'StripTags' )->setRequired(true)->addFilter ( 'StringTrim' );
		$this->addElement ( $name );
		
		$temp = new Zend_Form_Element_Text ( 'Temperatur' );
		$temp->setLabel ( 'Temperatur in °C:' )->addFilter ( 'StripTags' )->setRequired(true)->addFilter ( 'StringTrim' );
		$this->addElement ( $temp );
		
		$pressure = new Zend_Form_Element_Text ( 'Betriebsdruck' );
		$pressure->setLabel ( 'Betriebsdruck in bar:' )->addFilter ( 'StripTags' )->setRequired(true)->addFilter ( 'StringTrim' );
		$this->addElement ( $pressure );
		
		$material = new Zend_Form_Element_Select ( 'Stutzenmaterial' );
		$material->setLabel ( 'Stutzenmaterial:' )->addFilter ( 'StripTags' )->addFilter ( 'StringTrim' );
		$db_mapper = new Application_Model_WaermetauscherMapper ();
		$materialien = $db_mapper->getStutzenmaterialListe ();
		foreach ( $materialien as $einmaterial ) {
			$material->addMultiOption ( "$einmaterial", $einmaterial );
		}
		$this->addElement ( $material );
		
		$maxHeight = new Zend_Form_Element_Text ( 'Hoehe' );
		$maxHeight->setLabel ( 'Maximale Höhe in mm:' )->addFilter ( 'StripTags' )->setRequired(true)->addFilter ( 'StringTrim' );
		$this->addElement ( $maxHeight );
		
		$maxWidth = new Zend_Form_Element_Text ( 'Breite' );
		$maxWidth->setLabel ( 'Maximale Breite in mm:' )->addFilter ( 'StripTags' )->setRequired(true)->addFilter ( 'StringTrim' );
		$this->addElement ( $maxWidth );
		
		$plates = new Zend_Form_Element_Text ( 'plates' );
		$plates->setLabel ( 'Anzahl der Platten: ' )->setRequired(true);
		$this->addElement ( $plates );
		
		$length = new Zend_Form_Element_Text ( 'length' );
		$length->setLabel ( 'Länge in mm: ' )->setRequired(true);
		$this->addElement ( $length );
		
		$weight = new Zend_Form_Element_Text ( 'weight' );
		$weight->setLabel ( 'Leergewicht in Kg: ' )->setRequired(true);
		$this->addElement ( $weight );
		
		$area = new Zend_Form_Element_Text ( 'area' );
		$area->setLabel ( 'Fläche in m²: ' )->setRequired(true);
		$this->addElement ( $area );
		
		$anschluss = new Zend_Form_Element_MultiCheckbox ( 'Anschluss');
		$anschluesse = $db_mapper->getAnschlussListe ();
		foreach ( $anschluesse as $anschluss ) {
			$anschluss->addMultiOption ( "$anschluss", "$anschluss" );
		}
		$anschluss->setLabel ( 'Anschlüsse:' )->setRequired(true);
		$this->addElement ( $anschluss );
		
		$einsatzgbt = new Zend_Form_Element_MultiCheckbox ( 'Einsatzgebiet' );
		$einsatzgbt->setLabel ( 'Einsatzgebiete:' )->addFilter ( 'StripTags' )->setRequired(true)->addFilter ( 'StringTrim' );
		$gebiete = $db_mapper->getEinsatzgebietListe ();
		foreach ( $gebiete as $gebiet ) {
			$einsatzgbt->addMultiOption ( "$gebiet", "$gebiet" );
		}
		$this->addElement ( $einsatzgbt );
		
		
			
		$submit = new Zend_Form_Element_Submit ( 'submit' );
		$submit->setLabel ( 'Artikel erzeugen' );
		$this->addElement ( $submit );
		
	}
}