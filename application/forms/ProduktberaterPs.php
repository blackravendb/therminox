<?php
class Application_Form_ProduktberaterPs extends Zend_Form {
	
	 public function __construct($options = null)
    {	
    	parent::__construct($options);
    	
    	$this->setAttrib('id', 'produktberaterPs');
    	
    	$wtVal = new Zend_Validate_Digits('1234567890');
    	
    	$wtmapper = new Application_Model_PufferspeicherMapper();
        $einsatzgebiete = $wtmapper->getEinsatzgebietListe();
        $anschluesse = $wtmapper->getAnschlussListe();
        
        $einsatzgbt = new Zend_Form_Element_Select('Einsatzgebiet');
        $einsatzgbt->setLabel('Einsatzgebiet:')
        			->addMultiOption('Bitte wählen', 'Bitte wählen');
        foreach($einsatzgebiete as $value){
        	$einsatzgbt->addMultiOption((string)$value, (string)$value); //funktioniert!
        }
        $einsatzgbt->addFilter('StripTags')
           			->addFilter('StringTrim');
       	
       	$minSpeicherinhalt = new Zend_Form_Element_Text('minSpeicherinhalt');
		$minSpeicherinhalt->setLabel('minimaler Speicherinhalt:')
			 	->addValidator($wtVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
       			
       	$maxSpeicherinhalt = new Zend_Form_Element_Text('maxSpeicherinhalt');
		$maxSpeicherinhalt->setLabel('maximaler Speicherinhalt:')
			 	->addValidator($wtVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
        		
        $minDruck = new Zend_Form_Element_Text('minDruck');
		$minDruck->setLabel('minimaler Betriebsdruck')
		    	->addValidator($wtVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
        		
		$maxDruck = new Zend_Form_Element_Text('maxDruck');
		$maxDruck->setLabel('maximaler Betriebsdruck')
		    	->addValidator($wtVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
		
		$submit = new Zend_Form_Element_Submit('artikelVorschlagen');
        $submit->setLabel('Artikel vorschlagen');
        	
        $this->addElements(array($einsatzgbt, $minSpeicherinhalt, $maxSpeicherinhalt, $minDruck, $maxDruck, $submit));
	}
  }