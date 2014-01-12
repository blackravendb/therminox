<?php
class Application_Form_AngebotErstellen extends App_Form {
	
	public function __construct($options = null) {
		
		parent::__construct ( $options );
		
		$data = new Application_Model_Angebotskorb();
		$data = $this->offer_data;
		$articles = $data->getAngebot();
		foreach ($articles as $pos => $article){
			echo $article->getStatus();
		}
				
		$extraInfo = new Zend_Form_Element_Textarea('extraInfo');
		$extraInfo->setLabel('Weiter würden mich folgende Informationen interessieren:')
		->addFilter('StripTags')
		->addFilter('StringTrim');
		
		$addMore = new Zend_Form_Element_Submit('addMore');
		$addMore->setLabel('Weitere Artikel zum Angebot hinzufügen');
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Angebot absenden');
		
		$this->addElements(array($extraInfo, $addMore, $submit));
		$this->addElement('hidden', 'return', array(
				'value' => Zend_Controller_Front::getInstance()->getRequest()->getRequestUri(),
		));
	}
	
}