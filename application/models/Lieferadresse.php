<?php

class Application_Model_Lieferadresse extends Application_Model_TableAbstract
{
	protected $_id;
	protected $_benutzer_email;
	protected $_firma;
	protected $_nachname;
	protected $_vorname;
	protected $_strasse;
	protected $_plz;
	protected $_ort;
	protected $_land;
	protected $_anrede;
	
	public function toArray() {
		return array(
				"id" => $this->_id,
				"benutzer_email" => $this->_benutzer_email,
				"firma" => $this->_firma,
				"nachname" => $this->_nachname,
				"vorname" => $this->_vorname,
				"strasse" => $this->_strasse,
				"plz" => $this->_plz,
				"ort" => $this->_ort,
				"land" => $this->_land,
				"anrede" => $this->_anrede
		);
	}
	
	//primary key, Auto Increment
	protected function setId($id)
	{
		$this->_id = (int) $id;
		return $this;
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	//Wird beim Datenupload gesetzt
	protected function setBenutzer_email($email)
	{
		if($this->_benutzer_email !== $email) {
			$this->_changed['benutzer_email'] = 1;
			$this->_benutzer_email =  $email;
		}		
		return $this;
	}
	
	public function getBenutzer_email()
	{
		return $this->_benutzer_email;
	}
	
	public function setFirma($firma)
	{
		if($this->_firma !== $firma) {
			$this->_changed['firma'] = 1;
			$this->_firma =  $firma;
		}		
		return $this;
	}
	
	public function getFirma()
	{
		return $this->_firma;
	}
	
	public function setNachname($name)
	{
		if($this->_nachname !== $name) {
			$this->_changed['nachname'] = 1;
			$this->_nachname =  $name;
		}
		
		return $this;
	}
	
	public function getNachname()
	{
		return $this->_nachname;
	}
	
	public function setVorname($name)
	{
		if($this->_vorname !== $name) {
			$this->_changed['vorname'] = 1;
			$this->_vorname =  $name;
		}		
		return $this;
	}
	
	public function getVorname()
	{
		return $this->_vorname;
	}

	public function setStrasse($strasse) {
		if($this->_strasse !== $strasse) {
			$this->_changed['strasse'] = 1;
			$this->_strasse = $strasse;
		}
	}
	
	public function getStrasse() {
		return $this->_strasse;
	}
	
	public function setPlz($plz) {
		if($this->_plz !== $plz) {
			$this->_changed['plz'] = 1;
			$this->_plz = $plz;
		}		
	}
	
	public function getPlz(){
		return $this->_plz;
	}
	
	public function setOrt($ort) {
		if($this->_ort !== $ort) {
			$this->_changed['ort'] = 1;
			$this->_ort = $ort;
		}
		
	}
	
	public function getOrt(){
		return $this->_ort;
	}
	
	public function setLand($land) {
		if($this->_land !== $land) {
			$this->_changed['land'] = 1;
			$this->_land = $land;
		}
	}
	
	public function getLand(){
		return $this->_land;
	}
	
	public function setAnrede($anrede) {
		if($this->_anrede !== $anrede) {
			$this->_changed['anrede'] = 1;
			$this->_anrede = $anrede;
		}
	}
	
	public function getAnrede() {
		return $this->_Anrede;
	}

}
