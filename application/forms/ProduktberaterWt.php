<?php
class Application_Form_ProduktberaterWt extends Zend_Form {
	
	protected $_minTemp = null;
	protected $_maxTemp = null;
	protected $_minHeight = null;
	protected $_maxHeight = null;
	protected $_minWidth = null;
	protected $_maxWidth = null;
	protected $_minLength = null;
	protected $_maxLength = null;
	
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
	
	public function setMinLength($var){
		$this->_minLength = $var;
		return $this;
	}
	
	public function getMinLength(){
		return $this->_minLength;
	}
	
	public function setMaxLength($var){
		$this->_maxLength = $var;
		return $this;
	}
	
	public function getMaxLength(){
		return $this->_maxLength;
	}
	
	 public function __construct($options = null)
    {	
    	parent::__construct($options);
		
    	$tempVal = new Zend_Validate_Between(array('min' => $this->getMinTemp(), 'max' => $this->getMaxTemp())); //min 155 //max 195
    	$heightVal = new Zend_Validate_Between(array('min' => $this->getMinHeight(), 'max' => $this->getMaxHeight())); //min 170 max 1100
    	$widthVal = new Zend_Validate_Between(array('min' => $this->getMinWidth(), 'max' => $this->getMaxWidth())); //min 70 max 400
    	$lengthVal = new Zend_Validate_Between(array('min' => $this->getMinLength(), 'max' => $this->getMaxLength())); //min 20 max 500
    	
    	$temp = new Zend_Form_Element_Text('Temperatur');
    	$temp->setLabel('Temperatur:')
    		->addValidator($tempVal)
    		->addFilter('StripTags')
            ->addFilter('StringTrim')
        	->addErrorMessage('Im Moment sind nur Wärmetauscher mit einer Temperatur zwischen ' . $tempVal->getMin() . '°C und ' . $tempVal->getMax() . '°C verfügbar');
        
        $einsatzgbt = new Zend_Form_Element_Select('Einsatzgebiet');
        $einsatzgbt->setLabel('Einsatzgebiet:')
        			//->addMultiOptions() warten auf Datenbank
         			->addMultiOption('Fernwärme', 'Fernwärme')
         			->addMultiOption('Solaranlage', 'Solaranlage')
         			->addMultiOption('Erdbohrung', 'Erdbohrung')
        			->addFilter('StripTags')
           			->addFilter('StringTrim');
    	
        $anschluss1 = new Zend_Form_Element_Checkbox('Anschluss1');
       	$anschluss1->setLabel('3/8" IG');

       	$anschluss2 = new Zend_Form_Element_Checkbox('Anschluss2');
       	$anschluss2->setLabel('1/2" AG');
       	
       	$anschluss3 = new Zend_Form_Element_Checkbox('Anschluss3');
       	$anschluss3->setLabel('3/4" AG');
       /*
       $anschluss = new Zend_Form_Element_MultiCheckbox('Anschluss', array(
        		'multiOptions' => array(
       				'3/8" IG' => '3/8" IG', 
       				'1/2" AG' => '1/2" AG', 
       				'3/4" AG' => '3/4" AG'
       			)
       		));
       	$anschluss->setLabel('Anschlüsse:');
       	*/
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
		$maxHeight->setLabel('Maximale Höhe:')
			 	->addValidator($heightVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Im Moment sind nur Wärmetauscher mit einer Höhe zwischen ' . $heightVal->getMin() . '°C und ' . $heightVal->getMax() . '°C verfügbar');
				
		$maxWidth = new Zend_Form_Element_Text('Breite');
		$maxWidth->setLabel('Maximale Breite:')
		    	->addValidator($widthVal)
    			->addFilter('StripTags')
           	 	->addFilter('StringTrim')
        		->addErrorMessage('Im Moment sind nur Wärmetauscher mit einer Breite zwischen ' . $widthVal->getMin() . '°C und ' . $widthVal->getMax() . '°C verfügbar');
		
		$maxLength = new Zend_Form_Element_Text('Laenge');
		$maxLength->setLabel('Maximale Länge:')
		    	->addValidator($lengthVal)
    			->addFilter('StripTags')
            	->addFilter('StringTrim')
        		->addErrorMessage('Im Moment sind nur Wärmetauscher mit einer Temperatur zwischen' . $lengthVal->getMin() . '°C und ' . $lengthVal->getMax() . '°C verfügbar');	
       	
		
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Artikel vorschlagen');
        	
        $this->addElements(array($temp, $einsatzgbt, $anschluss1, $anschluss2, $anschluss3, $maxHeight, $maxWidth, $maxLength, $submit));
	}
  }