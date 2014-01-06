<?php

class Application_Model_PufferspeicherEinsatzgebiet  extends Application_Model_TableAbstract {
	protected $_id;
	protected $_einsatzgebiet;
	
	public function toArray() {
		return array(
				"id" => $this->_id,
				"einsatzgebiet" => $this->_einsatzgebiet
		);
	}
	
	protected function setId($id) {
		$this->_id = (int)$id;
		return $this;
	}
	
	public function getId() {
		return $this_id;
	}
	
	public function setEinsatzgebiet($gebiet) {
		$this->_einsatzgebiet = $gebiet;
		return $this;
	}
	
	public function getEinsatzgebiet() {
		return $this->_einsatzgebiet;
	}

}

