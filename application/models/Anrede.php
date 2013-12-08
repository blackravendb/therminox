<?php

class Application_Model_Anrede
{
	protected $_id;
	protected $_anrede;
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Ungültige Guestbook Eigenschaft');
		}
		return $this->$method();
	}	
	
	public function getid()
	{
		return $this->_id;
	}
	
	
	public function getAnrede()
	{
		return $this->_anrede;
	}

}

