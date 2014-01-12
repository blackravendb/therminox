<?php
class Application_Form_WtBearbeiten extends Zend_Form {
	
	private $dbdata = null;
	
	public function init(){
		$checkedAnschluesse = array();
		$checkedEinsatzgebiete = array();
		$i = 0;
	}
	
	public function setDbdata($data_object){
		$this->dbdata = $data_object;
	}
	
	public function startform(){
		
		$val = new Zend_Validate_Digits('1234567890');
		
		$wtmapper = new Application_Model_WaermetauscherMapper();
        $einsatzgebiete = $wtmapper->getEinsatzgebietListe();
        $anschluesse = $wtmapper->getAnschlussListe();
        $stutzenmaterialien = $wtmapper->getStutzenmaterialListe();
		
		$name = new Zend_Form_Element_Text('Artikelname');
		$name->setLabel('Artikelname:')
		->setValue($this->dbdata->getModel())
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Bitte in alle Felder bis auf einen gültigen Wert eingeben!');
		 
		$temp = new Zend_Form_Element_Text('Temperatur');
		$temp->setLabel('Temperatur (°C):')
		->addValidator($val)
		->setValue($this->dbdata->getTemperatur())
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Bitte in alle Felder bis auf einen gültigen Wert eingeben!');
		
		$height = new Zend_Form_Element_Text('Hoehe');
		$height->setLabel('Höhe (mm):')
		->addValidator($val)
		->setValue($this->dbdata->getHoehe())
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Bitte in alle Felder bis auf einen gültigen Wert eingeben!');

		$width = new Zend_Form_Element_Text('Breite');
		$width->setLabel('Breite (mm):')
		->addValidator($val)
		->setValue($this->dbdata->getBreite())
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Bitte in alle Felder bis auf einen gültigen Wert eingeben!');

		$stutzenmaterial = new Zend_Form_Element_Select('Stutzenmaterial');
        $stutzenmaterial->setLabel('Stutzenmaterial:')
        				->setValue($this->dbdata->getStutzenmaterial());
        foreach($stutzenmaterialien as $value){
        	$stutzenmaterial->addMultiOption((string)$value, (string)$value); 
        }
        $stutzenmaterial->addFilter('StripTags')
           				->addFilter('StringTrim');
           			
		$betriebsdruck = new Zend_Form_Element_Text('Betriebsdruck');
		$betriebsdruck->setLabel('Betriebsdruck (bar):')
		->addValidator($val)
		->setValue($this->dbdata->getBetriebsdruck())
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Bitte in alle Felder bis auf einen gültigen Wert eingeben!');
		
		$anschluss = new Zend_Form_Element_MultiCheckbox('Anschluss');
		$anschluss->setLabel('Anschlüsse:')
		->setRequired(true)
		->addErrorMessage('Ein Wärmetauscher muss einen Anschluss besitzen!');
		foreach($anschluesse as $value){
       		$anschluss->addMultiOption((string)$value, (string)$value);
       	}
		foreach($this->dbdata->getWaermetauscherAnschluss() as $ans){
	    					$checkedAnschluesse[] = $ans->getAnschluss();
	  						}
		$anschluss->setValue($checkedAnschluesse);

		$einsatzgbt = new Zend_Form_Element_MultiCheckbox('Einsatzgebiete');
		$einsatzgbt->setLabel('Einsatzgebiete:');
		foreach($einsatzgebiete as $value){
        	$einsatzgbt->addMultiOption((string)$value, (string)$value);
        }
        $einsatzgbtValues = $this->dbdata->getWaermetauscherEinsatzgebiet();
        if(!empty($einsatzgbtValues)){
	        foreach($einsatzgbtValues as $value){
	        	$checkedEinsatzgebiete[] = $value->getEinsatzgebiet();
	        }
	        $einsatzgbt->setValue($checkedEinsatzgebiete);
        }
        
		$submit = new Zend_Form_Element_Submit('artikelAendern');
		$submit->setLabel('Artikel ändern');
		
		$unterkategorien = new Zend_Form_Element_Submit('unterkategorien');
		$unterkategorien->setLabel('Unterkategorien bearbeiten');
		 
		$this->addElements(array($name, $temp, $height, $width, $stutzenmaterial, $betriebsdruck, $anschluss, $einsatzgbt, $submit, $unterkategorien));
	}
}