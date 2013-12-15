<?php
class Application_Form_ProduktberaterWt extends App_Form {

	 public function __construct($options = null)
    {	
    	parent::__construct($options);
    	
    	$temp = new Zend_Form_Element_Text('Temperatur');
    	$temp->setLabel('Temperatur:')
    		->addValidator('numbers', false, array('[1-9]'))
    		->addValidator('StringLength', false, array(3))
    		->addFilter('StripTags')
            ->addFilter('StringTrim');
        	
        $einsatzgbt = new Zend_Form_Element_Select('Einsatzgebiet');
        $einsatzgbt->setLabel('Einsatzgebiet:')
        			->addMultiOption($einsatzgbt)
        			->addFilter('StripTags')
           			->addFilter('StringTrim');
    	
        $anschluss = new Zend_Form_Element_Multiselect('Anschluss');
        $anschluss->setLabel('Anschlüsse:');
        		//->addMultiOptions($anschlüsse); warten auf Datenbank
        		
        		
		$maxHeight = new ZendX_JQuery_Form_Element_Slider('Hoehe');
		$maxHeight->setLabel('Maximale Höhe:')
				->setJQueryParams(array('min' => 170, 'max' => 1100, 'value' => 1));	
				
		$maxWidth = new ZendX_JQuery_Form_Element_Slider('Breite');
		$maxWidth->setLabel('Maximale Breite:')
				->setJQueryParams(array('min' => 70, 'max' => 400, 'value' => 1));
		
		$maxLength = new ZendX_JQuery_Form_Element_Slider('Länge');
		$maxLength->setLabel('Maximale Länge:')
				->setJQueryParams(array('min' => 20, 'max' => 500, 'value' => 1));
		
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Artikel vorschlagen');
       
        $this->addElements(array($temp, $einsatzgbt, $anschluss, $maxHeight, $maxWidth, $submit));
	}
}