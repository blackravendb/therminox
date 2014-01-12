<?php

class Application_Model_Angebotskorb extends Application_Model_TableAbstract {

	protected $_id;
	protected $_benutzer_email;
	protected $_angebot;
	protected $_erstelldatum;
	
	public function toArray() {
		return array(
				"id" => $this->_id,
				"benutzer_email" => $this->_benutzer_email,
				"angebot" => $this->_angebot,
				"erstelldatum" => $this->_erstelldatum
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
	
	public function deleteAngebot(Application_Model_Angebot $angebot) {
		if(empty($this->_angebot) || empty ($angebot)){
			return false;
		}
		foreach($this->_angebot as $key => $value) {
			if($value->getArtikelnummer() === $angebot->getArtikelnummer()){
				unset($this->_angebot[$key]);
				return true;
			}
		}
		return false;
		
	}
	
	public function getAngebot() {
		return $this->_angebot;
	}
	
	protected function setErstelldatum($erstelldatum) {
		$this->_erstelldatum = $erstelldatum;
	}
	
	public function getErstelldatum() {
		return $this->_erstelldatum;
	}
}

