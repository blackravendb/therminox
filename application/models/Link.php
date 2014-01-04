<?php

class Application_Model_Link extends Application_Model_TableAbstract{
	protected $_id;
	protected $_email;
	protected $_hexaString;
	protected $_typ;
	
	public function toArray() {
		return array(
				"id" => $this->_id,
				"email" => $this->_email,
				"hexaString" => $this->_hexaString,
				"typ" => $this_typ
		);
	}
	
	//kein setId benötigt, da Feld AI ist
	
	public function getId(){
		return $this->_id;
	}
	
	public function setEmail($email) {
		if($email == "")
			return false;
	
		$this->_email =  $email;
		return $this;
	}
	
	public function getEmail() {
		return $this->_email;
	}
	
	public function setHexaString($string) {
		if($string == "")
			return false;
		
		$this->_hexaString = $string;
	}
	
	public function getHexaString(){
		return $this->_hexaString;
	}
	
	public function setTyp($typ){
		if($typ == "")
			return false;
		
		$this->_typ = (int)$typ;
	}
	
	public function getTyp() {
		return $this->_typ;
	}

}

