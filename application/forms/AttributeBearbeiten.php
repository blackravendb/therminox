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
		
		$new = new Zend_Form_Element_Text('attributHinzufuegen');
		$new->setLabel('Attribut hinzufuegen:')
			->addFilter('StripTags')
			->addFilter('StringTrim');
		
		$submit = new Zend_Form_Element_Submit('hinzufuegen');
		$submit->setLabel('hinzufügen');
		
		$attribut = new Zend_Form_Element_MultiCheckbox('AttributLoeschen');
		$attribut->setLabel('zu löschende Attribute:');
		foreach($this->dbdata as $value){
			$attribut->addMultiOption((string)$value, (string)$value);
		}
		
		$attribLoeschen = new Zend_Form_Element_Submit('attributLoeschen');
		$attribLoeschen->setLabel('Löschen');
		
		$this->addElements(array($new, $submit, $attribut, $attribLoeschen));
		}
	}