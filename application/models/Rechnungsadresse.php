<?php

class Application_Model_Rechnungsadresse extends Application_Model_TableAbstract
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
	
	public function setId($id)
	{
		$this->_id = (int) $id;
		return $this;
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function setBenutzer_email($email)
	{
		$this->_benutzer_email =  $email;
		return $this;
	}
	
	public function getBenutzer_email()
	{
		return $this->_benutzer_email;
	}
	
	public function setFirma($firma)
	{
		$this->_firma =  $firma;
		return $this;
	}
	
	public function getFirma()
	{
		return $this->_firma;
	}
	
	public function setNachname($name)
	{
		$this->_nachname =  $name;
		return $this;
	}
	
	public function getNachname()
	{
		return $this->_nachname;
	}
	
	public function setVorname($name)
	{
		$this->_vorname =  $name;
		return $this;
	}
	
	public function getVorname()
	{
		return $this->_vorname;
	}

	public function setStrasse($strasse){
		$this->_strasse = $strasse;
	}
	
	public function getStrasse(){
		return $this->_strasse;
	}
	
	public function setPlz($plz){
		$this->_plz = $plz;
	}
	
	public function getPlz(){
		return $this->_plz;
	}
	
	public function setOrt($ort){
		$this->_ort = $ort;
	}
	
	public function getOrt(){
		return $this->_ort;
	}
	
	public function setLand($land){
		$this->_land = $land;
	}
	
	public function getLand(){
		return $this->_land;
	}
	
	public function setAnrede($anrede){
		$this->_anrede = $anrede;
	}
	
	public function getAnrede(){
		return $this->_Anrede;
	}

}
