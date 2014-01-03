<?php

abstract class Application_Model_TableAbstract
{
	protected $_changed;
	
	public abstract function toArray();
	
	public function __construct(array $options = null) {
		if (is_array($options)) {
			$this->setOptions($options);
		}
		
		//Fals Objekt neu erstellt wurde (für z.B. inserts) existiert _changed noch nicht
		if(isset($this->_changed)){
			foreach($this->_changed as $key => $value){
				$this->_changed[$key] = 0;
			}
		}
	}	
	
	public function __set($name, $value) {
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Ungültiger Setter');
		}
		$this->$method($value);
	}
	
	public function __get($name) {
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Ungültiger Getter');
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
	
	public function isChanged($name) {
		if(isset($this->_changed[$name])){
			if($this->_changed[$name] == 1)
				return true;
		}
		return false;
	}

}

