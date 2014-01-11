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
		$name->setLabel('Artikelname:')
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

		$einsatzgbt = new Zend_Form_Element_Select('Einsatzgebiet');
		$einsatzgbt->setLabel('Einsatzgebiet:')
		->addMultiOption('Fernwärme', 'Fernwärme')
		->addMultiOption('Solaranlage', 'Solaranlage')
		->addMultiOption('Erdbohrung', 'Erdbohrung')
		->addFilter('StripTags')
		->addFilter('StringTrim');
		 
		$anschluss = new Zend_Form_Element_MultiCheckbox('Anschluss', array(
				'multiOptions' => array(
						'3/8" IG' => '3/8" IG',
						'1/2" AG' => '1/2" AG',
						'3/4" AG' => '3/4" AG'
				)
		));
		$anschluss->setLabel('Anschlüsse:');
		
		$material = new Zend_Form_Element_Text('Stutzenmaterial');
		$material->setLabel('Stutzenmaterial:')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$pictures = new Zend_Form_Element_File('Bilder');
		$pictures->setLabel('Artikelbilder hochladen')
		->addValidator('Extension', false, 'png')
		//->setDestination('_files/images/waermetauscher')
		->addValidator('Size', false, 102400) // Limitiert auf 100k
		->setMaxFileSize(102400); // Limitiert dateigröße clientseitig
		
		/*
		 $anschluss = new Zend_Form_Element_Multiselect('Anschluss');
		$anschluss->setLabel('Anschlüsse:')
		//->addMultiOptions($anschlüsse); warten auf Datenbank
		->addMultiOption('3/8" IG','3/8" IG')
		->addMultiOption('1/2" AG', '1/2" AG')
		->addMultiOption('3/4" AG', '3/4" AG');
		*/

		/*	$maxHeight = new ZendX_JQuery_Form_Element_Slider('Hoehe');
		 $maxHeight->setLabel('Maximale Höhe:')
		->setJQueryParams(array('min' => 170, 'max' => 1100, 'value' => 1));

		$maxWidth = new ZendX_JQuery_Form_Element_Slider('Breite');
		$maxWidth->setLabel('Maximale Breite:')
		->setJQueryParams(array('min' => 70, 'max' => 400, 'value' => 1));

		$maxLength = new ZendX_JQuery_Form_Element_Slider('Länge');
		$maxLength->setLabel('Maximale Länge:')
		->setJQueryParams(array('min' => 20, 'max' => 500, 'value' => 1)); */

		$maxHeight = new Zend_Form_Element_Text('Hoehe');
		$maxHeight->setLabel('Maximale Höhe in mm:')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$maxWidth = new Zend_Form_Element_Text('Breite');
		$maxWidth->setLabel('Maximale Breite in mm:')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Artikel erzeugen');
		 
		$this->addElements(array($name,$temp, $pressure, $einsatzgbt, $anschluss, $maxHeight, $maxWidth, $material,$pictures, $submit));
	}
}