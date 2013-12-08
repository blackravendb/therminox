<?php

class Application_Model_Begrifferklaerung
{
	protected $_id;
	protected $_erklaerung;
	
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
			throw new Exception('Ungültige Guestbook Eigenschaft');
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Ungültige Guestbook Eigenschaft');
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
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function setErklaerung($string)
	{
		$this->_erklaerung =  $string;
		return $this;
	}
	
	public function getErklaerung()
	{
		return $this->_erklaerung;
	}

}

