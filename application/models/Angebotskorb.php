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
	
	public function getAngebot() {
		return $this->_angebot;
	}
}

