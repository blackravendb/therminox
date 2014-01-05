<?php
class Application_Form_ProduktberaterWt extends Zend_Form {

	protected $_minMem = null;
	protected $_maxMem = null;
	protected $_minWeight = null;
	protected $_maxWeight = null;
	
	public function setMinMem($var){
		$this->_minMem = $var;
		return $this;
	}
	
	public function getMinMem(){
		return $this->_minMem;
	}
	
	public function setMaxMem($var){
		$this->_maxMem = $var;
		return $this;
	}
	
	public function getMaxMem(){
		return $this->_MaxMem;
	}
	
	public function setMinWeight($var){
		$this->_minWeight = $var;
		return $this;
	}
	
	public function getMinWeight(){
		return $this->_minWeight;
	}
	
	public function setMaxWeight($var){
		$this->_maxWeight = $var;
		return $this;
	}
	
	public function getMaxWeight(){
		return $this->_maxWeight;
	}
	
	 public function __construct($options = null)
    {	
    	parent::__construct($options);
    	
    	$memVal = new Zend_Validate_Between(array('min' => 150, 'max' => 2000));
    	$weightVal = new Zend_Validate_Between(array('min' => 40, 'max' => 300));
        
    	$typ1 = new Zend_Form_Element_Checkbox('Typ1');
    	$typ1->setLabel('SHI/SHE');
    	$typ2 = new Zend_Form_Element_Checkbox('Typ2');
    	$typ2->setLabel('VVI');
    	$typ3 = new Zend_Form_Element_Checkbox('Typ3');
    	$typ3->setLabel('VVE');
    	
    	/*
   		$typ = new Zend_Form_Element_MultiCheckbox('Typ', array(
        		'multiOptions' => array(
   					'SHI/SHE' => 'SHI/SHE',
       				'VVI' => 'VVI', 
       				'VVE' => 'VVE', 
       			)
       		));
       	$typ->setLabel('Typ:');
       	*/
       	
    	$heizwendel1 = new Zend_Form_Element_Checkbox('Heizwendel1');
    	$heizwendel1->setLabel('1 Heizwendel');
    	
    	$heizwendel2 = new Zend_Form_Element_Checkbox('Heizwendel2');
    	$heizwendel2->setLabel('2 Heizwendel');
    	
    	/*
        $heizwendel = new Zend_Form_Element_MultiCheckbox('Heizwendel', array(
        		'multiOptions' => array(
       				'1' => '1', 
       				'2' => '2', 
       			)
       		));
       	$typ->setLabel('Heizwendel:');
       	*/
    		
       	$speicherinhalt = new Zend_Form_Element_Text('Speicherinhalt');
		$speicherinhalt->setLabel('Speicherinhalt:')
			 	->addValidator($memVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Im Moment sind nur Wasserwärmer mit einem Speicherinhalt zwischen ' . $memVal->getMin() . 'L und ' . $memVal->getMax() . 'L verfügbar');
				
		$leergewicht = new Zend_Form_Element_Text('Leergewicht');
		$leergewicht->setLabel('Leergewicht:')
		    	->addValidator($weightVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Im Moment sind nur Wasserwärmer mit einem Leergewicht zwischen ' . $weightVal->getMin() . 'kg und ' . $weightVal->getMax() . 'kg verfügbar');
       	
        $anschlussKw1 = new Zend_Form_Element_Checkbox('AnschlussKw1');
    	$anschlussKw1->setLabel('2"IG');
		$anschlussKw2 = new Zend_Form_Element_Checkbox('AnschlussKw2');
    	$anschlussKw2->setLabel('1 1/2"AG');
    	$anschlussKw3 = new Zend_Form_Element_Checkbox('AnschlussKw3');
    	$anschlussKw3->setLabel('1"AG');
    	$anschlussKw4 = new Zend_Form_Element_Checkbox('AnschlussKw4');
    	$anschlussKw4->setLabel('1 1/2"IG');
    	$anschlussKw5 = new Zend_Form_Element_Checkbox('AnschlussKw5');
    	$anschlussKw5->setLabel('1"IG');
    	$anschlussKw6 = new Zend_Form_Element_Checkbox('AnschlussKw6');
    	$anschlussKw6->setLabel('1 1/4"IG');
    	
        /*
        $anschlussKw = new Zend_Form_Element_MultiCheckbox('AnschlussKaltwasser', array(
        		'multiOptions' => array(
       				'2"IG' => '2"IG', 
       				'1 1/2"AG' => '1 1/2"AG', 
        			'1"AG' => '1"AG',
        			'1 1/2"IG' => '1 1/2"IG',
        			'1"IG' => '1"IG',
        			'1 1/4"IG' => '1 1/4"IG',
       			)
       		));
       	$typ->setLabel('Anschluss Kaltwasser:');
        */

    	$anschlussWw1 = new Zend_Form_Element_Checkbox('AnschlussWw1');
    	$anschlussWw2->setLabel('2"IG');
		$anschlussWw2 = new Zend_Form_Element_Checkbox('AnschlussWw2');
    	$anschlussWw2->setLabel('1 1/2"AG');
    	$anschlussWw3 = new Zend_Form_Element_Checkbox('anschlussWw3');
    	$anschlussWw3->setLabel('1"AG');
    	$anschlussWw4 = new Zend_Form_Element_Checkbox('anschlussWw4');
    	$anschlussWw4->setLabel('1 1/2"IG');
    	$anschlussWw5 = new Zend_Form_Element_Checkbox('anschlussWw5');
    	$anschlussWw5->setLabel('1"IG');
    	$anschlussWw6 = new Zend_Form_Element_Checkbox('anschlussWw6');
    	$anschlussWw6->setLabel('1 1/4"IG');
    		
        /*		
        $anschlussWw = new Zend_Form_Element_MultiCheckbox('AnschlussWarmwasser', array(
        		'multiOptions' => array(
       				'2"IG' => '2"IG', 
       				'1 1/2"AG' => '1 1/2"AG', 
        			'1"AG' => '1"AG',
        			'1 1/2"IG' => '1 1/2"IG',
        			'1"IG' => '1"IG',
        			'1 1/4"IG' => '1 1/4"IG',
       			)
       		));
       	$typ->setLabel('Anschluss Warmwasser:'); 
       	*/
        		
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Artikel vorschlagen');
        	
        $this->addElements(array($typ, $heizwendel1, $heizwendel2, $speicherinhalt, $leergewicht, 
        						$anschlussKw1, $anschlussKw2, $anschlussKw3, $anschlussKw4, 
        						$anschlussKw5, $anschlussKw6, $anschlussWw1, $anschlussWw2, 
        						$anschlussWw3, $anschlussWw4, $anschlussWw5, $anschlussWw6, 
        						$anschlussWw, $submit));
	}
  }