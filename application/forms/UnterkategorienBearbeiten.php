<?php
class Application_Form_UnterkategorienBearbeiten extends Zend_Form {
	
	private $dbdata = null;
	
	public function init(){

	}
	
	public function setDbdata($data_object){
		$this->dbdata = $data_object;
	}
	
	public function startform(){
		
		$val1 = new Zend_Validate_Digits('1234567890');
		
		$platten = new Zend_Form_Element_Text('AnzahlPlatten');
		$platten->setLabel('Anzahl Platten:')
		->addValidator($val1)
		->setValue($this->dbdata->getPlatten())
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Eingaben überprüfen!');
		
		$laenge = new Zend_Form_Element_Text('Laenge');
		$laenge->setLabel('Länge (mm):')
		->addValidator($val1)
		->setValue($this->dbdata->getLaenge())
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Eingaben überprüfen!');

		$leergewichtValue = $this->dbdata->getLeergewicht();
		$leergewichtValue = str_replace(".", ",", $leergewichtValue);
		
		$leergewicht = new Zend_Form_Element_Text('Leergewicht');
		$leergewicht->setLabel('Leergewicht (kg):')
		->addValidator('Float')
		->setValue($leergewichtValue)
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Eingaben überprüfen!');

		
		$flaecheValue = $this->dbdata->getFlaeche();
		$flaecheValue = str_replace(".", ",", $flaecheValue);
		
		$flaeche = new Zend_Form_Element_Text('Flaeche');
		$flaeche->setLabel('Fläche (m²):')
		->addValidator('Float')
		->setValue($flaecheValue)
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addErrorMessage('Eingaben überprüfen!');
		
		$inhaltPrimaerValue = $this->dbdata->getInhaltPrimaer();
		
		if(!empty($inhaltPrimaerValue)){
			$inhaltPrimaerValue = str_replace(".", ",", $inhaltPrimaerValue);
			
			$inhaltPrimaer = new Zend_Form_Element_Text('inhaltPrimaer');
			$inhaltPrimaer->setLabel('Inhalt Primär (L)')
			->addValidator('Float')
			->setValue($inhaltPrimaerValue)
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addErrorMessage('Eingaben überprüfen!');
			
			$this->addElement($inhaltPrimaer);
		}
		
		$inhaltSekundaerValue = $this->dbdata->getInhaltSekundaer();
			
		if(!empty($inhaltSekundaerValue)){
			$inhaltSekundaerValue = str_replace(".", ",", $inhaltSekundaerValue);
			$inhaltSekundaer = new Zend_Form_Element_Text('inhaltSekundaer');
			$inhaltSekundaer->setLabel('Inhalt Sekundär (L)')
			->addValidator('Float')
			->setValue($inhaltSekundaerValue)
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addErrorMessage('Eingaben überprüfen!');
			
			$this->addElement($inhaltSekundaer);
		}
		
		$submit = new Zend_Form_Element_Submit('unterkategorieAendern');
		$submit->setLabel('Unterkategorie ändern');
		
		$this->addElements(array($platten, $laenge, $leergewicht, $flaeche, $submit));
	}
}