<?php

class Application_Model_Lieferadresse
{
	protected $_id;
	protected $_benutzer_email;
	protected $_firma;
	protected $_nachname;
	protected $_vorname;
	protected $_strasse;
	protected $_plz;
	protected $_land;
	protected $_anrede;
	
	public function __construct(array $options = null)
	{
		if (is_array($options)) {
			$this->setOptions($options);
		}
	}
	
	public function __set($name, $value)
	{
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Ungültige Benutzer Eigenschaft');
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Ungültige Benutzer Eigenschaft');
		}
		return $this->$method();
	}
	
	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
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
	
	public function setLand($lanad){
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
