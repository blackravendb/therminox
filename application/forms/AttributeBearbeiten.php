<?php
class Application_Form_AttributeBearbeiten extends Zend_Form{
	
	private $dbdata = null;
	
	public function init(){
		
	}
	
	public function setDbdata($data_object){
		$this->dbdata = $data_object;
	}
	
	public function startform(){
		
		//TODO Validators
		
		$attribut = new Zend_Form_Element_MultiCheckbox('AttributLoeschen');
		$attribut->setLabel('Bitte alle zu löschenden Attribute auswählen:');
		foreach($this->dbdata as $value){
			$attribut->addMultiOption((string)$value, (string)$value);
		}

		$attribLoeschen = new Zend_Form_Element_Submit('attributLoeschen');
		$attribLoeschen->setLabel('Löschen');
		
		$new = new Zend_Form_Element_Text('attributHinzufuegen');
		$new->setLabel('Attribut hinzufuegen:')
			->addFilter('StripTags')
			->addFilter('StringTrim');
		
		$submit = new Zend_Form_Element_Submit('hinzufuegen');
		$submit->setLabel('hinzufügen');
			
		$this->addElements(array($attribut, $attribLoeschen, $new, $submit));
		}
	}