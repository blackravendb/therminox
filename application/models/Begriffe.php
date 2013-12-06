<?php

class Application_Model_Begriffe
{
	protected $_Begriff;
	protected $_Erklaerung_ID;
	
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
	
// 	public function setComment($text)
// 	{
// 		$this->_comment = (string) $text;
// 		return $this;
// 	}
	
// 	public function getComment()
// 	{
// 		return $this->_comment;
// 	}
	
// 	public function setEmail($email)
// 	{
// 		$this->_email = (string) $email;
// 		return $this;
// 	}
	
// 	public function getEmail()
// 	{
// 		return $this->_email;
// 	}
	
	public function setErklaerungID($ts)
	{
		$this->_Erklaerung_ID = (int) $ts;
		return $this;
	}
	
	public function getErklaerungID()
	{
		return $this->_Erklaerung_ID;
	}
	
	public function setBegriff($id)
	{
		$this->_Begriff =  $id;
		return $this;
	}
	
	public function getBegriff()
	{
		return $this->_Begriff;
	}

}

