<?php
class Application_Form_ProduktberaterWt extends Zend_Form {

	protected $_minMem = null;
	protected $_maxMem = null;
	protected $_minWeight = null;
	protected $_maxWeight = null;
	protected $_minCold = null;
	protected $_maxCold = null;
	protected $_minWarm = null;
	protected $_maxWarm = null;
	protected $_minLoad = null;
	protected $_maxLoad = null;
	protected $_minThermo = null;
	protected $_maxThermo = null;
	
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
		return $this->_maxMem;
	}
	
	public function setMinWeight($var){
		$this->_maxWeight = $var;
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
	
	public function getMinCold(){
		return $this->_minCold;
	}
	
	public function setMinCold($var){
		$this->_minCold = $var;
		return $this;
	}
	
	public function getMaxCold(){
		return $this->_maxCold;
	}
	
	public function setMaxCold($var){
		$this->_maxCold = $var;
		return $this;
	}
	
	public function setMinWarm($var){
		$this->_minWarm = $var;
		return $this;
	}
	
	public function getMinWarm(){
		return $this->minWarm;
	}
	
	public function setMaxWarm($var){
		$this->_maxWarm = $var;
		return $this;
	}
	
	public function getMaxWarm(){
		return $this->_maxWarm;
	}
	
	public function getMinLoad(){
		return $this->_minLoad;
	}
	
	public function setMinLoad($var){
		$this->_minLoad = $var;
		return $this;
	}
	
	public function getMaxLoad(){
		return $this->_maxLoad;
	}
	
	public function setMaxLoad($var){
		$this->_maxLoad = $var;
		return $this;
	}
	
	public function getMinThermo(){
		return $this->_minThermo;
	}
	
	public function setMinThermo($var){
		$this->_minThermo = $var;
		return $this;
	}
	
	public function getMaxThermo(){
		return $this->_maxThermo;
	}
	
	public function setMaxThermo($var){
		$this->_maxThermo = $var;
		return $this;
	}
	
	 public function __construct($options = null)
    {	
    	parent::__construct($options);
    	
    	$memVal = new Zend_Validate_Between(array('min' => $this->getMinMem(), 'max' => $this->getMaxMem()));
    	$weightVal = new Zend_Validate_Between(array('min' => $this->getMinWeight(), 'max' => $this->getMaxWeight()));
    	$coldVal = new Zend_Validate_Between(array('min' => $this->getMinCold(), 'max' => $this->getMaxCold()));
    	$warmVal = new Zend_Validate_Between(array('min' => $this->getMinWarm(), 'max' => $this->getMaxWarm()));
    	$loadVal = new Zend_Validate_Between(array('min' => $this->getMinLoad(), 'max' => $this->getMaxLoad()));
    	$thermoVal = new Zend_Validate_Between(array('min' => $this->getMinThermo(), 'max' => $this->getMaxThermo()));
    	
    	$typ1 = new Zend_Form_Element_Checkbox('Typ1');
    	$typ1->setLabel('VVX');
    	
    	$typ2 = new Zend_Form_Element_Checkbox('Typ2');
    	$typ2->setLabel('LAS');
    	
    	/*
        $typ = new Zend_Form_Element_MultiCheckbox('Typ', array(
        		'multiOptions' => array(
       				'VVX' => 'VVX', 
       				'LAS' => 'LAS', 
       			)
       		));
       	$typ->setLabel('Typ:');
       	*/
    	
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
		
        /*
       	$anschlussZk =  new Zend_Form_Element_MultiCheckbox('AnschlussZirkulation', array(
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
       	*/
       	
       $anschlussTm = new Zend_Form_Element_Text('AnschlussThermometer');
       $anschlussTm->setLabel('Anschluss Ladestutzen:')
       	->addValidator($thermoVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Im Moment sind nur Pufferspeicher mit einem Thermometeranschluss zwischen ' . $thermoVal->getMin() . 'mm und ' . $thermoVal->getMax() . 'mm verfügbar');
      	
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Artikel vorschlagen');
        	
        $this->addElements(array($typ1, $typ2, $speicherinhalt, $leergewicht, $anschlussKw, $anschlussWm, $anschlussLs, $anschlussZk1, 
        						$anschlussZk2, $anschlussZk3, $anschlussZk4, $anschlussZk5, $anschlussZk6, $anschlussTm, $submit));
	}
  }