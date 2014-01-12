<?php
class Application_Form_PsBearbeiten extends Zend_Form {
	
	private $dbdata = null;
	
	public function init(){
		$checkedEinsatzgebiete = array();
		$i = 0;
	}
	
	public function setDbdata($data_object){
		$this->dbdata = $data_object;
	}
	
public function startform(){
		
		$val = new Zend_Validate_Digits('1234567890');
		
		$wtmapper = new Application_Model_PufferspeicherMapper();
        $einsatzgebiete = $wtmapper->getEinsatzgebietListe();
		
		$name = new Zend_Form_Element_Text('Artikelname');
		$name->setLabel('Artikelname:')
		->setRequired(true)
		->setValue($this->dbdata->getModel())
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Bitte für alle Felder richtige Werte eingeben!');
		
		$speicherinhalt = new Zend_Form_Element_Text('Speicherinhalt');
		$speicherinhalt->setLabel('Speicherinhalt:')
		->addValidator($val)
		->setRequired(true)
		->setValue($this->dbdata->getSpeicherinhalt())
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Bitte für alle Felder richtige Werte eingeben!');

		$betriebsdruck = new Zend_Form_Element_Text('Betriebsdruck');
		$betriebsdruck->setLabel('Betriebsdruck (bar):')
		->addValidator($val)
		->setRequired(true)
		->setValue($this->dbdata->getBetriebsdruck())
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Bitte für alle Felder richtige Werte eingeben!');
		
		$temperatur = new Zend_Form_Element_Text('Temperatur');
		$temperatur->setLabel('Temperatur (°C):')
		->addValidator($val)
		->setRequired(true)
		->setValue($this->dbdata->getTemperaturMax())
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Bitte für alle Felder richtige Werte eingeben!');
		
		$einsatzgbt = new Zend_Form_Element_MultiCheckbox('EinsatzgebietePs');
		$einsatzgbt->setLabel('Einsatzgebiete:');
		foreach($einsatzgebiete as $value){
        	$einsatzgbt->addMultiOption((string)$value, (string)$value);
        }
        $einsatzgbtValues = $this->dbdata->getEinsatzgebiet();
        if(!empty($einsatzgbtValues)){
	        foreach($this->dbdata->getEinsatzgebiet() as $value){
	        	$checkedEinsatzgebiete[] = $value->getEinsatzgebiet();
	        }
			$einsatzgbt->setValue($checkedEinsatzgebiete);
        }
		$submit = new Zend_Form_Element_Submit('artikelAendern');
		$submit->setLabel('Artikel ändern');
		 
		$this->addElements(array($name, $speicherinhalt, $betriebsdruck, $temperatur, $einsatzgbt, $submit));
	}
}