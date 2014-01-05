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
		$this->_email =  $email;
		return $this;
	}
	
	public function getEmail() {
		return $this->_email;
	}
	
	public function setNachname($name) {
		if($this->_nachname != $name) {
			$this->_changed['nachname'] = 1;
			$this->_nachname =  $name;
		}
		return $this;
	}
	
	public function getNachname() {
		return $this->_nachname;
	}
	
	public function setVorname($name) {
		if($this->_vorname != $name) {
			$this->_changed['vorname'] = 1;
			$this->_vorname =  $name;
		}
		return $this;
	}
	
	public function getVorname() {
		return $this->_vorname;
	}
	
	//Methode für Konstruktur, dass Gehashter Wert nicht nochmal gehast wird und sich so bei jedem neuen Objektaufruf ändert
	protected function setPasswort($pw) {
		return $this->_passwort = $pw;
	}
	
	public function setKlartextPasswort($pw) {
		$this->setSalt(App_Util::generateHexString());
		$this->_passwort = sha1($pw.$this->getSalt());
		$this->_changed['passwort'] = 1;
		return $this;
	}
	
	public function getPasswort() {
		return $this->_passwort;
	}
	
	protected function setSalt($salt){
			$this->_salt = $salt;
			$this->_changed['salt'] = 1;
	}
	
	public function getSalt(){
		return $this->_salt;
	}
	
	public function setBerechtigung($berechtigung) {
		if($this->_berechtigung != $berechtigung) {
			$this->_changed['berechtigung'] = 1;
			$this->_berechtigung =  $berechtigung;
		}
		return $this;
	}
	
	public function getBerechtigung() {
		return $this->_berechtigung;
	}

	public function setAnrede($anrede) {
		if($this->_anrede != $anrede) {
			$this->_changed['anrede'] = 1;
			$this->_anrede = $anrede;
		}
	}
	
	public function getAnrede() {
		return $this->_anrede;
	}
	
	public function setBestaetigt($boolean) {
		if($this->_bestaetigt !== $boolean) {
			$this->_changed['bestaetigt'] = 1;
			$this->_bestaetigt = $boolean;
		}
	}

	public function getBestaetigt(){
		return $this->_bestaetigt;
	}
}
