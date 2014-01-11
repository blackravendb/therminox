<?php

class Application_Model_Angebotskorb extends Application_Model_TableAbstract {

	protected $_id;
	protected $_benutzer_email;
	protected $_angebot;
	
	public function toArray() {
		return array(
				"id" => $this->_id,
				"benutzer_email" => $this->_benutzer_email,
				"angebot" => $this->_angebot
		);
	}
	
	protected function setId($id) {
		$this->_id = (int)$id;
		return $this;
	}
	
	public function getId() {
		return $this->_id;
	}
	
	public function setBenutzer_email($email) {
		$this->_benutzer_email = $email;
		return $this;
	}
	
	public function getBenutzer_email() {
		return $this->_benutzer_email;
	}
	
	protected function setAngebot($angebot) {
		$this->_angebot = $angebot;
		return $this;
	}
	
	public function insertAngebot(Application_Model_Angebot $angebot) {
		$enthalten = false;
		
		//Noch kein Wert gesetzt, Array anlegen und Wert zuweisen
		if(empty($this->_angebot)){
			$this->_angebot = array($angebot);
			$this->_changed['angebot'] = 1;
			return true;
		}
		foreach($this->_angebot as $value){
			if($value->getArtikelnummer() === $angebot->getArtikelnummer()) {
				$enthalten = true;
				break;
			}
		}
		if(!$enthalten) {
			$this->_angebot[] = $angebot;
			$this->_changed['angebot'] = 1;
			return true;
		}
		return false;
	}
	
	public function getAngebot() {
		return $this->_angebot;
	}
}

