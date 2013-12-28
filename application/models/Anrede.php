<?php

class Application_Model_Anrede
{
	protected $_id;
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
			throw new Exception('Ungültige Anrede Eigenschaft');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Ungültige Anrede Eigenschaft');
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

	public function setId($id) {
		$this->_id = (int) $id;
		return $this;
	}

	public function getId() {
		return $this->_id;
	}

	public function setAnrede($anrede) {
		$this->_anrede =  $anrede;
		return $this;
	}
	
	public function getAnrede() {
		return $this->_anrede;
	}
}



