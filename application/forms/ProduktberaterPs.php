<?php
class Application_Form_ProduktberaterWt extends Zend_Form {
	
	 public function __construct($options = null)
    {	
    	parent::__construct($options);
    	
    	$psVal = new Zend_Validate_Digits('1234567890');
    	
    	$typ = new Zend_Form_Element_Select('VVX/LAS');
    	$typ->setLabel('VVX/LAS')
    		->addMultiOption('Bitte wählen')
    		->addMultiOption('VVX', 'VVX')
    		->addMultiOption('LAS', 'LAS');
    	
    	/*
        $typ = new Zend_Form_Element_MultiCheckbox('Typ', array(
        		'multiOptions' => array(
       				'VVX' => 'VVX', 
       				'LAS' => 'LAS', 
       			)
       		));
       	$typ->setLabel('Typ:');
       	*/
    	
    	$einsatzgbt = new Zend_Form_Element_Select('Einsatzgebiet');
        $einsatzgbt->setLabel('Einsatzgebiet:')
        			//->addMultiOptions() warten auf Datenbank
        			->addMultiOption('Bitte wählen', 'Bitte wählen')
         			->addMultiOption('Fernwärme', 'Fernwärme')
         			->addMultiOption('Solaranlage', 'Solaranlage')
         			->addMultiOption('Erdbohrung', 'Erdbohrung')
         			->addMultiOption('Umrüstung von PKW`s auf Rapsöl', 'Umrüstung von PKW`s auf Rapsöl')
        			->addFilter('StripTags')
           			->addFilter('StringTrim');
           			
       	$speicherinhalt = new Zend_Form_Element_Text('Speicherinhalt');
		$speicherinhalt->setLabel('Speicherinhalt:')
			 	->addValidator($psVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
				
		$leergewicht = new Zend_Form_Element_Text('Leergewicht');
		$leergewicht->setLabel('Leergewicht in kg:')
		    	->addValidator($psVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
       	
        $betriebsdruck = new Zend_Form_Element_Text('Betriebsdruck');
    	$betriebsdruck->setLabel('Betriebsdruck:')
    		->addValidator($psVal)
    		->addFilter('StripTags')
            ->addFilter('StringTrim')
        	->addErrorMessage('Bitte nur Zahlen eingeben!');	

        $maxTemp = new Zend_Form_Element_Text('TemperaturMax');
    	$maxTemp->setLabel('Maximaltemperatur:')
    		->addValidator($psVal)
    		->addFilter('StripTags')
            ->addFilter('StringTrim')
        	->addErrorMessage('Bitte nur Zahlen eingeben!');	
        		
        /*		
		$anschlussKw = new Zend_Form_Element_Text('AnschlussKaltwasser');
       	$anschlussKw->setLabel('Anschluss Kaltwasser in mm:')
       			->addValidator($psVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
       	
       	$anschlussWm = new Zend_Form_Element_Text('AnschlussWarmwasser');
       	$anschlussWm->setLabel('Anschluss Warmwasser in mm:')
       	->addValidator($psVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
       	
       	$anschlussLs = new Zend_Form_Element_Text('AnschlussLadestutzen');
       	$anschlussLs->setLabel('Anschluss Ladestutzen in mm:')
       	->addValidator($psVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
      	
        $anschlussZk = new Zend_Form_Element_MultiCheckbox('AnschlussZk', array(
        			'multiOptions' => array('80mm', '100mm', '1020mm', '1620mm', '1710mm', '1940mm')
        	));
        $anschlussZk->setLabel('Anschlüsse:')
        			->setValue(array(0, 1, 2, 3, 4, 5));
   
		$anschlussZk1 = new Zend_Form_Element_Checkbox('AnschlussZk1');
		$anschlussZk1->setLabel('80mm');
		
		$anschlussZk2 = new Zend_Form_Element_Checkbox('AnschlussZk2');
		$anschlussZk2->setLabel('100mm');
		
		$anschlussZk3 = new Zend_Form_Element_Checkbox('AnschlussZk3');
		$anschlussZk3->setLabel('1020mm');
		
		$anschlussZk4 = new Zend_Form_Element_Checkbox('AnschlussZk4');
		$anschlussZk4->setLabel('1620mm');
		
		$anschlussZk5 = new Zend_Form_Element_Checkbox('AnschlussZk5');
		$anschlussZk5->setLabel('1710mm');
		
		$anschlussZk6 = new Zend_Form_Element_Checkbox('AnschlussZk6');
		$anschlussZk6->setLabel('1940mm');
		
       	
       $anschlussTm = new Zend_Form_Element_Text('AnschlussThermometer');
       $anschlussTm->setLabel('Anschluss Ladestutzen in mm:')
       	->addValidator($psVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
      	
      	*/
      	
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Artikel vorschlagen');
        	
        $this->addElements(array($typ, $einsatzgbt, $speicherinhalt, $leergewicht, $betriebsdruck, 
        							$maxTemp, $submit));
	}
  }