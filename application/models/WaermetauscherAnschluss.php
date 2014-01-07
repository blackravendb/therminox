<?php

class Application_Model_WaermetauscherAnschluss extends Application_Model_TableAbstract
{
	protected $_id;
	protected $_anschluss;
	
	public function toArray() {
		return array(
				"id" => $this->_id,
				"anschluss" => $this->_anschluss
		);
	}
	
	//Primary Key protected function, benötig außerdem kein Zugriff auf _changed
	protected function setId ($id){
		if($id == "")
			return false;
	
		$this->_id = (int)$id;
		return $this;
	}
	
	public function getId (){
		return $this->_id;
	}
	
	public function setAnschluss ($anschluss){
		$this->_anschluss = $anschluss;
		return $this;
	}
	
	public function getAnschluss (){
		return $this->_anschluss;
	}
}

