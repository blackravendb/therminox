<?php

class Application_Model_Benutzer extends Application_Model_TableAbstract
{
	protected $_email;
	protected $_nachname;
	protected $_vorname;
	protected $_passwort;
	protected $_salt;
	protected $_berechtigung;
	protected $_anrede;
	protected $_bestaetigt;
	
	public function toArray() {
		return array(
				"email" => $this->_email,
				"nachname" => $this->_nachname,
				"vorname" => $this->_vorname,
				"passwort" => $this->_passwort,
				"salt" => $this->_salt,
				"berechtigung" => $this->_berechtigung,
				"anrede" => $this->_anrede,
				"bestaetigt" => $this->_bestaetigt
		);
	}
	
	//Primary Key protected function, benötig außerdem kein Zugriff auf _changed
	protected function setEmail($email) {
		if($email == "")
			return false;
		
		$this->_email =  $email;
		return $this;
	}
	
	public function getEmail() {
		return $this->_email;
	}
	
	public function setNachname($name) {
		if($name == "")
			return false;
		
		$this->_changed['nachname'] = 1;
		$this->_nachname =  $name;
		return $this;
	}
	
	public function getNachname() {
		return $this->_nachname;
	}
	
	public function setVorname($name)
	{
		if($name == "")
			return false;
		
		$this->_changed['vorname'] = 1;
		$this->_vorname =  $name;
		return $this;
	}
	
	public function getVorname() {
		return $this->_vorname;
	}
	
	public function setPasswort($pw) {
		if($pw == "")
			return false;
		
		$this->_changed['passwort'] = 1;
		$this->_passwort =  $pw;
		return $this;
	}
	
	public function getPasswort() {
		return $this->_passwort;
	}
	
	public function setSalt($salt){
		if($salt == "")
			return false;
		
		$this->_salt = $salt;
	}
	
	public function getSalt(){
		return $this->_salt;
	}
	
	public function setBerechtigung($berechtigung) {
		if($berechtigung == "")
			return false;
		
		$this->_changed['berechtigung'] = 1;
		$this->_berechtigung =  $berechtigung;
		return $this;
	}
	
	public function getBerechtigung() {
		return $this->_berechtigung;
	}

	public function setAnrede($anrede) {
		if($anrede == "")
			return false;
		
		$this->_changed['anrede'] = 1;
		$this->_anrede = $anrede;
	}
	
	public function getAnrede() {
		return $this->_anrede;
	}
	
	public function setBestaetigt($boolean) {
		$this->_bestaetigt = $boolean;
	}

	public function getBestaetigt(){
		return $this->_bestaetigt;
	}
}
