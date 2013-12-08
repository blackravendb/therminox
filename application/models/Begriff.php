<?php

class Application_Model_Begriff
{
	protected $_begriff;
	protected $_begrifferklaerung_id;
	
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
	
	public function setBegrifferklaerung_id($ts)
	{
		$this->_begrifferklaerung_id = (int) $ts;
		return $this;
	}
	
	public function getBegrifferklaerung_id()
	{
		return $this->_begrifferklaerung_id;
	}
	
	public function setBegriff($id)
	{
		$this->_begriff =  $id;
		return $this;
	}
	
	public function getBegriff()
	{
		return $this->_begriff;
	}

}

