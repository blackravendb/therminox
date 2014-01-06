<?php
class Application_Form_ProduktberaterWt extends Zend_Form {
	
	/*
	protected $_minTemp = null;
	protected $_maxTemp = null;
	protected $_minHeight = null;
	protected $_maxHeight = null;
	protected $_minWidth = null;
	protected $_maxWidth = null;
	
	public function setMinTemp($var){
		$this->_minTemp = $var;
		return $this;
	}
	
	public function getMinTemp(){
		return $this->_minTemp;
	}

	public function setMaxTemp($var){
		$this->_maxTemp = $var;
		return $this;
	}
	
	public function getMaxTemp(){
		return $this->_maxTemp;
	}
	
	public function setMinHeigth($var){
		$this->_minHeight = $var;
		return $this;
	}
	
	public function getMinHeight(){
		return $this->_minHeight;
	}
	
	public function setMaxHeight($var){
		$this->_maxHeight = $var;
		return $this;
	}
	
	public function getMaxHeight(){
		return $this->_maxHeight;
	}
	
	public function setMinWidth($var){
		$this->_minWidth = $var;
		return $this;
	}
	
	public function getMinWidth(){
		return $this->_minWidth;
	}
	
	public function setMaxWidth($var){
		$this->_maxWidth = $var;
		return $this;
	}
	
	public function getMaxWidth(){
		return $this->_maxWidth;
	}
	*/
	
	 public function __construct($options = null)
    {	
    	parent::__construct($options);
		
    	/*
    	$tempVal = new Zend_Validate_Between(array('min' => $this->getMinTemp(), 'max' => $this->getMaxTemp())); //min 155 //max 195
    	$heightVal = new Zend_Validate_Between(array('min' => $this->getMinHeight(), 'max' => $this->getMaxHeight())); //min 170 max 1100
    	$widthVal = new Zend_Validate_Between(array('min' => $this->getMinWidth(), 'max' => $this->getMaxWidth())); //min 70 max 400
    	$lengthVal = new Zend_Validate_Between(array('min' => $this->getMinLength(), 'max' => $this->getMaxLength())); //min 20 max 500
    	*/
    	
    	$wtVal = new Zend_Validate_Digits('1234567890');
    	
    	$minTemp = new Zend_Form_Element_Text('TemperaturMin');
    	$minTemp->setLabel('Minimaltemperatur:')
    		->addValidator($wtVal)
    		->addFilter('StripTags')
            ->addFilter('StringTrim') 
        	->addErrorMessage('Bitte nur Zahlen eingeben!');
        
       	$maxTemp = new Zend_Form_Element_Text('TemperaturMax');
    	$maxTemp->setLabel('Höchsttemperatur:')
    		->addValidator($wtVal)
    		->addFilter('StripTags')
            ->addFilter('StringTrim')
        	->addErrorMessage('Bitte nur Zahlen eingeben!');
        	
        $einsatzgbt = new Zend_Form_Element_Select('Einsatzgebiet');
        $einsatzgbt->setLabel('Einsatzgebiet:')
        			//->addMultiOptions() warten auf Datenbank
        			->addMultiOption('Bitte wählen', 'Bitte wählen')
         			->addMultiOption('Fernwärme', 'Fernwärme')
         			->addMultiOption('Solaranlage', 'Solaranlage')
         			->addMultiOption('Erdbohrung', 'Erdbohrung')
        			->addFilter('StripTags')
           			->addFilter('StringTrim');
    	
           			/*
        $anschluss1 = new Zend_Form_Element_Checkbox('Anschluss1');
       	$anschluss1->setLabel('3/8" IG');

       	$anschluss2 = new Zend_Form_Element_Checkbox('Anschluss2');
       	$anschluss2->setLabel('1/2" AG');
       	
       	$anschluss3 = new Zend_Form_Element_Checkbox('Anschluss3');
       	$anschluss3->setLabel('3/4" AG');
		*/
           			
       $anschluss = new Zend_Form_Element_MultiCheckbox('Anschluss', array(
        		'multiOptions' => array('3/8" IG', '1/2" AG', '3/4" AG')
       		));
       	$anschluss->setLabel('Anschlüsse:')
       			->setValue(array(0,1,2));
       	
       
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
       	
       	$minHeight = new Zend_Form_Element_Text('HoeheMin');
		$minHeight->setLabel('Minimalhöhe:')
			 	->addValidator($wtVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
       			
       	$maxHeight = new Zend_Form_Element_Text('HoeheMax');
		$maxHeight->setLabel('Maximale Höhe:')
			 	->addValidator($wtVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
        		
        $minWidth = new Zend_Form_Element_Text('BreiteMin');
		$minWidth->setLabel('Minimalbreite:')
		    	->addValidator($wtVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
        		
		$maxWidth = new Zend_Form_Element_Text('BreiteMax');
		$maxWidth->setLabel('Maximalbreite:')
		    	->addValidator($wtVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Bitte nur Zahlen eingeben!');
		
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Artikel vorschlagen');
        	
        $this->addElements(array($minTemp, $maxTemp, $einsatzgbt, $anschluss, $minHeight, $maxHeight, $minWidth, $maxWidth, $submit));
	}
  }