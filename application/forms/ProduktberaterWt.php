<?php
class Application_Form_ProduktberaterWt extends Zend_Form {

	 public function __construct($options = null)
    {	
    	parent::__construct($options);
    	
    	$temp = new Zend_Form_Element_Text('Temperatur');
    	$temp->setLabel('Temperatur:')
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
				->setJQueryParams(array('min' => 0, 'max' => 60, 'value' => 15));
		$this->addElements(array($slider));
		
		$maxWidth = new ZendX_JQuery_Form_Element_Slider('Breite');
		$maxWidth->setLabel('Maximale Breite:')
				->setJQueryParams(array('min' => 0, 'max' => 60, 'value' => 15));
		$this->addElements(array($slider));
		
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Artikel vorschlagen');
       
        $this->addElements(array($temp, $einsatzgbt, $anschluss, $maxHeight, $maxWidth, $submit));
	}
}