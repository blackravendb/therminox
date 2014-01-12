<?php

class Application_Model_Angebot extends Application_Model_TableAbstract {

	protected $_angebotskorb_id;
	protected $_artikelnummer_id;
	protected $_status;
	protected $_bemerkung;
	
	public function toArray() {
		return array(
				"angebotskorb_id" => $this->_angebotskorb_id,
				"artikelnummer_id" => $this->_artikelnummer_id,
				"status" => $this->_status,
				"bemerkung" => $this->_bemerkung,
		);
	}
	
	protected function setAngebotskorb_id($id) {
		$this->_angebotskorb_id = (int)$id;
		return $this;
	}
	
	public function getAngebotskorb_id() {
		return $this->_angebotskorb_id;
	}
	
	protected function setArtikelnummer_id($id) {
		$this->_artikelnummer_id =(int)$id;
	}
	
	public function setArtikelnummer($id) {
		if($this->_artikelnummer_id !== $id){
			$this->_artikelnummer_id = (int)$id;
		}
		return $this;
	}
	
	public function getArtikelnummer() {
		return $this->_artikelnummer_id;
	}
	
	public function setStatus($status) {
		if($this->_status !== $status){
			$this->_status = $status;
		}
		return $this;
	}
	
	public function getStatus() {
		return $this->_status;
	}
	
	public function setBemerkung($text) {
		if($this->_bemerkung !== $text){
			$this->_bemerkung = $text;
		}
		return $this;
	}
	
	public function getBemerkung() {
		return $this->_bemerkung;
	}
	
}
