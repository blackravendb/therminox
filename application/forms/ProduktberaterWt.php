<?php
class Application_Form_ProduktberaterWt extends App_Form {

	 public function __construct($options = null)
    {	
    	parent::__construct($options);
    	
    	$tempVal = new Zend_Validate_Between(array('min' => 155, 'max' => 195));
    	$heightVal = new Zend_Validate_Between(array('min' => 170, 'max' => 1100));
    	$widthVal = new Zend_Validate_Between(array('min' => 70, 'max' => 400));
    	$lengthVal = new Zend_Validate_Between(array('min' => 20, 'max' => 500));
    	
    	$temp = new Zend_Form_Element_Text('Temperatur');
    	$temp->setLabel('Temperatur:')
    		->addValidator($tempVal)
    		->addFilter('StripTags')
            ->addFilter('StringTrim')
        	->addErrorMessage('Im Moment sind nur Wärmetauscher mit einer Temperatur zwischen ' . $tempVal->getMax() . '°C und ' . $tempVal->getMin() . '°C verfügbar');
        
        $einsatzgbt = new Zend_Form_Element_Select('Einsatzgebiet');
        $einsatzgbt->setLabel('Einsatzgebiet:')
        			//->addMultiOptions() warten auf Datenbank
         			->addMultiOption('Fernwärme', 'Fernwärme')
         			->addMultiOption('Solaranlage', 'Solaranlage')
         			->addMultiOption('Erdbohrung', 'Erdbohrung')
        			->addFilter('StripTags')
           			->addFilter('StringTrim');
    	
       $anschluss = new Zend_Form_Element_MultiCheckbox('Anschluss', array(
        		'multiOptions' => array(
       				'3/8" IG' => '3/8" IG', 
       				'1/2" AG' => '1/2" AG', 
       				'3/4" AG' => '3/4" AG'
       			)
       		));
       	$anschluss->setLabel('Anschlüsse:');
       	
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
        	
        $this->addElements(array($tempVal, $heightVal, $widthVal, $lengthVal, $temp, $einsatzgbt, $anschluss, $maxHeight, $maxWidth, $maxLength, $submit));
	}
  }