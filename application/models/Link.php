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
				"typ" => $this->_typ
		);
	}
	
	//primary key
	protected function setId($id){
		$this->_id = $id;
		return $this;
	}
	
	public function getId(){
		return $this->_id;
	}
	
	public function setEmail($email) {
		$this->_email =  $email;
		return $this;
	}
	
	public function getEmail() {
		return $this->_email;
	}
	
	public function setHexaString($string) {
		$this->_hexaString = $string;
	}
	
	public function getHexaString(){
		return $this->_hexaString;
	}
	
	public function setTyp($typ){
		$this->_typ = (int)$typ;
	}
	
	public function getTyp() {
		return $this->_typ;
	}

}

