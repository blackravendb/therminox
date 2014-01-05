<?php

class Application_Model_WaermetauscherEinsatzgebiet extends Application_Model_TableAbstract
{
	protected $_id;
	protected $_einsatzgebiet;
	
	public function toArray() {
		return array(
				"id" => $this->_id,
				"einsatzgebiet" => $this->_einsatzgebiet
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
	
	public function setEinsatzgebiet ($gebiet){
		$this->_einsatzgebiet = $gebiet;
		return $this;
	}
	
	public function getEinsatzgebiet (){
		return $this->_einsatzgebiet;
	}
	

}

