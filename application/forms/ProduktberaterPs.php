<?php
class Application_Form_ProduktberaterWt extends App_Form {

	 public function __construct($options = null)
    {	
    	parent::__construct($options);
    	
    	$memVal = new Zend_Validate_Between(array('min' => 150, 'max' => 3000));
    	$weightVal = new Zend_Validate_Between(array('min' => 50, 'max' => 400));
    	$coldVal = new Zend_Validate_Between(array('min' => 1070, 'max' => 2800));
    	$warmVal = new Zend_Validate_Between(array('min' => 640, 'max' => 1865));
    	$loadVal = new Zend_Validate_Between(array('min' => 500, 'max' => 2675));
    	$thermoVal = new Zend_Validate_Between(array('min' => 290, 'max' => 1565));
    	
    	$typ = new Zend_Form_Element_Radio('Typ');
    	$typ->setLabel('Typ:')
    		//->addMultiOptions() warten auf Datenbank
         			->addMultiOption('VVX', 'VVX')
         			->addMultiOption('LAS', 'LAS');
               	
       	$speicherinhalt = new Zend_Form_Element_Text('Speicherinhalt');
		$speicherinhalt->setLabel('Speicherinhalt:')
			 	->addValidator($memVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Im Moment sind nur Pufferspeicher mit einem Speicherinhalt zwischen ' . $memVal->getMin() . 'L und ' . $memVal->getMax() . 'L verfügbar');
				
		$leergewicht = new Zend_Form_Element_Text('Leergewicht');
		$leergewicht->setLabel('Leergewicht:')
		    	->addValidator($weightVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Im Moment sind nur Pufferspeicher mit einem Leergewicht zwischen ' . $weightVal->getMin() . 'kg und ' . $weightVal->getMax() . 'kg verfügbar');
       	
		$anschlussKw = new Zend_Form_Element_Text('AnschlussKaltwasser');
       	$anschlussKw->setLabel('Anschluss Kaltwasser:')
       	->addValidator($coldVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Im Moment sind nur Pufferspeicher mit einem Kaltwasseranschluss zwischen ' . $coldVal->getMin() . 'mm und ' . $coldVal->getMax() . 'mm verfügbar');
       	
       	$anschlussWm = new Zend_Form_Element_Text('AnschlussWarmwasser');
       	$anschlussWm->setLabel('Anschluss Warmwasser:')
       	->addValidator($warmVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Im Moment sind nur Pufferspeicher mit einem Warmwasseranschluss zwischen ' . $warmVal->getMin() . 'mm und ' . $warmVal->getMax() . 'mm verfügbar');
       	
       	$anschlussLs = new Zend_Form_Element_Text('AnschlussLadestutzen');
       	$anschlussLs->setLabel('Anschluss Ladestutzen:')
       	->addValidator($loadVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Im Moment sind nur Pufferspeicher mit einem Ladestutzenanschluss zwischen ' . $loadVal->getMin() . 'mm und ' . $loadVal->getMax() . 'mm verfügbar');
      
       	$anschlussZk =  new Zend_Form_Element_Radio('AnschlussZirkulation', array(
        		'multiOptions' => array(
       				'80mm' => '80mm', 
       				'100mm' => '100mm', 
       				'1020mm' => '1020mm',
       				'1620mm' => '1620mm',
       				'1710mm' => '1710mm',
       				'1940mm' => '1940mm',
       			)
       		));
       	$anschlussZk->setLabel('Anschluss Zirkulation:');
       	
       $anschlussTm = new Zend_Form_Element_Text('AnschlussThermometer');
       $anschlussTm->setLabel('Anschluss Ladestutzen:')
       	->addValidator($thermoVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Im Moment sind nur Pufferspeicher mit einem Thermometeranschluss zwischen ' . $thermoVal->getMin() . 'mm und ' . $thermoVal->getMax() . 'mm verfügbar');
      	
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Artikel vorschlagen');
        	
        $this->addElements(array($typ, $speicherinhalt, $leergewicht, $anschlussKw, $anschlussWm, $anschlussLs, $anschlussZk, $anschlussTm, $submit));
	}
  }