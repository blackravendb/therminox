<?php
class Application_Form_PsErstellen extends App_Form {

	 public function __construct($options = null)
    {	
    	parent::__construct($options);
    	
    	$memVal = new Zend_Validate_Between(array('min' => 150, 'max' => 3000));
    	$weightVal = new Zend_Validate_Between(array('min' => 50, 'max' => 400));
    	$pressVal = new Zend_Validate_Between(array('min' => 1, 'max' => 300));
    	$thermoVal = new Zend_Validate_Between(array('min' => 1, 'max' => 8000));
    	
    	$name = new Zend_Form_Element_Text('Model');
    	$name->setLabel('Artikelmodell:')
    	->addFilter('StripTags')
    	->addFilter('StringTrim');
    	             	
       	$speicherinhalt = new Zend_Form_Element_Text('Speicherinhalt');
		$speicherinhalt->setLabel('Speicherinhalt in Liter:')
			 	->addValidator($memVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim');
				
		$leergewicht = new Zend_Form_Element_Text('Leergewicht');
		$leergewicht->setLabel('Leergewicht in Kg:')
		    	->addValidator($weightVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim');
       	
				
		$tempmax = new Zend_Form_Element_Text('TemperaturMax');
		$tempmax->setLabel('Maximale Temperatur in °C:')
		->addValidator($thermoVal)
		->addFilter('StripTags')
		->addFilter('StringTrim');
		
		
		$druck = new Zend_Form_Element_Text('Betriebsdruck');
		$druck->setLabel('Betriebsdruck in Bar:')
		->addValidator($pressVal)
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
		 	
       
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Artikel erzeugen');
        	
        $this->addElements(array($name, $speicherinhalt, $leergewicht, $tempmax, $druck,$einsatzgbt, $submit));
	}
  }