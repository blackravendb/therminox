<?php
class Application_Form_WwErstellen extends App_Form {

	 public function __construct($options = null)
    {	
    	parent::__construct($options);
    	
    	$memVal = new Zend_Validate_Between(array('min' => 150, 'max' => 2000));
    	$weightVal = new Zend_Validate_Between(array('min' => 40, 'max' => 300));
    	
    	$typ = new Zend_Form_Element_Radio('Typ');
    	$typ->setLabel('Typ:')
    		//->addMultiOptions() warten auf Datenbank
         			->addMultiOption('SHI/SHE', 'SHI/SHE')
         			->addMultiOption('VVI', 'VVI')
         			->addMultiOption('VVE', 'VVE');
        
        $heizwendel = new Zend_Form_Element_Radio('Heizwendel');
    	$heizwendel->setLabel('Heizwendel:')
    		//->addMultiOptions() warten auf Datenbank
         			->addMultiOption('1', '1')
         			->addMultiOption('2', '2');
         			
       	$speicherinhalt = new Zend_Form_Element_Text('Speicherinhalt');
		$speicherinhalt->setLabel('Speicherinhalt:')
			 	->addValidator($memVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim');
				
		$leergewicht = new Zend_Form_Element_Text('Leergewicht');
		$leergewicht->setLabel('Leergewicht:')
		    	->addValidator($weightVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim');
       	
		$anschlussKw = new Zend_Form_Element_Radio('AnschlussKaltwasser');
       	$anschlussKw->setLabel('Anschluss Kaltwasser:')
      		//->addMultiOptions() warten auf Datenbank
         			->addMultiOption('2"IG', '2"IG')
         			->addMultiOption('1 1/2"AG', '1 1/2"AG')
         			->addMultiOption('1"AG', '1"AG')
       				->addMultiOption('1 1/2"IG', '1 1/2"IG')
         			->addMultiOption('1"IG', '1"IG')
         			->addMultiOption('1 1/4"IG', '1 1/4"IG');
         
        $anschlussWw = new Zend_Form_Element_Radio('AnschlussWarmwasser');
       	$anschlussWw->setLabel('Anschluss Warmwasser:')
      		//->addMultiOptions() warten auf Datenbank
         			->addMultiOption('2"IG', '2"IG')
         			->addMultiOption('1 1/2"AG', '1 1/2"AG')
         			->addMultiOption('1"AG', '1"AG')
       				->addMultiOption('1 1/2"IG', '1 1/2"IG')
         			->addMultiOption('1"IG', '1"IG')
         			->addMultiOption('1 1/4"IG', '1 1/4"IG');
         		
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Artikel erstellen');
        	
        $this->addElements(array($typ, $speicherinhalt, $leergewicht, $anschlussKw, $anschlussWw, $submit));
	}
  }