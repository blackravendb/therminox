<?php
class Application_Form_ProduktberaterWt extends Zend_Form {
	
	 public function __construct($options = null)
    {	
    	parent::__construct($options);
    	
    	$this->setAttrib('id', 'produktberaterWt');
    	
    	$wtVal = new Zend_Validate_Digits('1234567890');
    	
    	$wtmapper = new Application_Model_WaermetauscherMapper();
        $einsatzgebiete = $wtmapper->getEinsatzgebietListe();
        $anschluesse = $wtmapper->getAnschlussListe();
        
    	$minTemp = new Zend_Form_Element_Text('TemperaturMin');
    	$minTemp->setLabel('Minimaltemperatur (°C):')
    		->addValidator($wtVal)
    		->addFilter('StripTags')
            ->addFilter('StringTrim') 
        	->addErrorMessage('Bitte nur Zahlen eingeben!');
        
       	$maxTemp = new Zend_Form_Element_Text('TemperaturMax');
    	$maxTemp->setLabel('Höchsttemperatur (°C):')
    		->addValidator($wtVal)
    		->addFilter('StripTags')
            ->addFilter('StringTrim')
        	->addErrorMessage('Bitte nur Zahlen eingeben!');
        
        $einsatzgbt = new Zend_Form_Element_Select('Einsatzgebiet');
        $einsatzgbt->setLabel('Einsatzgebiet:')
        			->addMultiOption('Bitte wählen', 'Bitte wählen');
        foreach($einsatzgebiete as $value){
        	$einsatzgbt->addMultiOption((string)$value, (string)$value); //funktioniert!
        }
        $einsatzgbt->addFilter('StripTags')
           			->addFilter('StringTrim');
       	
       	$minHeight = new Zend_Form_Element_Text('HoeheMin');
		$minHeight->setLabel('Minimalhöhe (mm):')
			 	->addValidator($wtVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
       			
       	$maxHeight = new Zend_Form_Element_Text('HoeheMax');
		$maxHeight->setLabel('Maximale Höhe (mm):')
			 	->addValidator($wtVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
        		
        $minWidth = new Zend_Form_Element_Text('BreiteMin');
		$minWidth->setLabel('Minimalbreite (mm):')
		    	->addValidator($wtVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
        		
		$maxWidth = new Zend_Form_Element_Text('BreiteMax');
		$maxWidth->setLabel('Maximalbreite (mm):')
		    	->addValidator($wtVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
        
        $anschluss = new Zend_Form_Element_MultiCheckbox('Anschluss');
        $anschluss->setLabel('Anschlüsse:');
       	foreach($anschluesse as $value){
       		$anschluss->addMultiOption((string)$value, (string)$value);
       	}
		$anschluss->setValue($anschluesse);
		
		$submit = new Zend_Form_Element_Submit('artikelVorschlagen');
        $submit->setLabel('Artikel vorschlagen');
        	
        $this->addElements(array($minTemp, $maxTemp, $einsatzgbt, $minHeight, $maxHeight, $minWidth, $maxWidth, $anschluss, $submit));
	}
  }