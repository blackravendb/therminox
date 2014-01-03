<?php

class Application_Model_Benutzer
{
	protected $_email;
	protected $_nachname;
	protected $_vorname;
	protected $_passwort;
	protected $_berechtigung;
	protected $_anrede;
	protected $_changed;
	
	public function __construct(array $options = null) {
		if (is_array($options)) {
			$this->setOptions($options);
		}
		
		$this->_changed = array(
				"nachname" => 0,
				"vorname" => 0,
				"passwort" => 0,
				"berechtigung" => 0,
				"anrede" => 0
				
		);		
	}
	
	public function __set($name, $value) {
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Ungültige Benutzer Eigenschaft');
		}
		$this->$method($value);
	}
	
	public function __get($name) {
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Ungültige Benutzer Eigenschaft');
		}
		return $this->$method();
	}
	
	public function setOptions(array $options) {
		$methods = get_class_methods($this);
		
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}
	
	public function toArray() {
		return array(
				"email" => $this->_email,
				"nachname" => $this->_nachname,
				"vorname" => $this->_vorname,
				"passwort" => $this->_passwort,
				"berechtigung" => $this->_berechtigung,
				"anrede" => $this->_anrede
		);
	}
	
	public function isChanged($name) {
		if(isset($this->_changed[$name])){
			if($this->_changed[$name] == 1)
				return true;
		}
		return false;
	}
	
	private function setEmail($email)
	{
		if($email == "")
			return false;
		
		$this->_email =  $email;
		return $this;
	}
	
	public function getEmail()
	{
		return $this->_email;
	}
	
	public function setNachname($name)
	{
		if($name == "")
			return false;
		
		$this->_changed['nachname'] = 1;
		$this->_nachname =  $name;
		return $this;
	}
	
	public function getNachname()
	{
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
	
	public function getVorname()
	{
		return $this->_vorname;
	}
	
	public function setPasswort($pw)
	{
		if($pw == "")
			return false;
		
		$this->_changed['passwort'] = 1;
		$this->_passwort =  $pw;
		return $this;
	}
	
	public function getPasswort()
	{
		return $this->_passwort;
	}
	
	public function setBerechtigung($berechtigung)
	{
		if($berechtigung == "")
			return false;
		
		$this->_changed['berechtigung'] = 1;
		$this->_berechtigung =  $berechtigung;
		return $this;
	}
	
	public function getBerechtigung()
	{
		return $this->_berechtigung;
	}

	public function setAnrede($anrede)
	{
		if($anrede == "")
			return false;
		
		$this->_changed['anrede'] = 1;
		$this->_anrede = $anrede;
	}
	
	public function getAnrede()
	{
		return $this->_anrede;
	}

}
