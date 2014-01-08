<?php

class Application_Model_Angebot extends Application_Model_TableAbstract {

	protected $_angebotskorb_id;
	protected $_artikelnummer;
	protected $_status;	
	
	public function toArray() {
		return array(
				"angebotskorb_id" => $this->_angebotskorb_id,
				"artikelnummer" => $this->_artikelnummer,
				"status" => $this->_status
		);
	}
	
	protected function setAngebotskorb_id($id) {
		$this->_angebotskorb_id = (int)$id;
		return $this;
	}
	
	public function getAngebotskorb_id() {
		return $this->_angebtskorb_id;
	}
	
	protected function setArtikelnummer($id) {
		$this->_artikelnummer = (int)$id;
		return $this;
	}
	
	public function getArtikelnummer() {
		return $this->_artikelnummer;
	}
	
	public function setStatus($status) {
		if($this->_status !== $status){
			$this->_status = $status;
		}
	}
	
	public function getStatus() {
		return $this->_status;
	}

}

