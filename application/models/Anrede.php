<?php

class Application_Model_Anrede extends Application_Model_TableAbstract
{
	protected $_id;
	protected $_anrede;

	public abstract function toArray(){
		return array(
				"id" => $this->_id,
				"anrede" => $this->_anrede,
		);
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



