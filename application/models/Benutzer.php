<?php

class Application_Model_Benutzer
{
	protected $_email;
	protected $_nachname;
	protected $_vorname;
	protected $_passwort;
	protected $_berechtigung;
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
	
	public function setEmail($email)
	{
		$this->_email =  $email;
		return $this;
	}
	
	public function getEmail()
	{
		return $this->_email;
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
	
	public function setPasswort($pw)
	{
		$this->_passwort =  $pw;
		return $this;
	}
	
	public function getPasswort()
	{
		return $this->_passwort;
	}
	
	public function setBerechtigung($blob)
	{
		$this->_berechtigung =  $blob;
		return $this;
	}
	
	public function getBerechtigung()
	{
		return $this->_berechtigung;
	}

	public function setAnrede($anrede){
		$this->_anrede = $anrede;
	}
	
	public function getAnrede(){
		return $this->_anrede;
	}

}
