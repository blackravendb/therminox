<?php

class Application_Model_Pufferspeicher extends Application_Model_TableAbstract {
	
	protected $_id;
	protected $_model;
	protected $_speicherinhalt;
	protected $_leergewicht;
	protected $_betriebsdruck;
	protected $_temperaturMax;
	protected $_einsatzgebiet;
	
	public function toArray() {
		return array(
				"id" => $this->_id,
				"model" => $this->_model,
				"speicherinhalt" => $this->_speicherinhalt,
				"leergewicht" => $this->_leergewicht,
				"betriebsdruck" => $this->_betriebsdruck,
				"temperaturMax" => $this->_temperaturMax,
				"einsatzgebiet" => $this->_einsatzgebiet
		);
	}
	
	//Primary Key
	protected function setId($id){
		$this->_id = (int)$id;
		return $this;
	}
	
	public function getId(){
		return $this->_id;
	}
	
	public function setModel($model) {
		$this->_model = $model;
		return $this;
	}
	
	public function getModel() {
		return $this->_model;
	}
	
	public function setSpeicherinhalt($inhalt) {
		$this->_speicherinhalt = $inhalt;
		return $this;
	}
	
	public function getSpeicherinhalt() {
		return $this->_speicherinhalt;
	}
	
	public function setLeergewicht($gewicht) {
		$this->_leergewicht = $gewicht;
		return $this;
	}
	
	public function getLeergewicht() {
		return $this->_leergewicht;
	}
	
	public function setBetriebsdruck($druck) {
		$this->_betriebsdruck = $druck;
		return $this;
	}
	
	public function getBetriebsdruck() {
		return $this->_betriebsdruck;
	}
	
	public function setTemperaturMax($temp) {
		$this->_temperaturMax = $temp;
		return $this;
	}
	
	public function getTemperaturMax() {
		return $this->_temperaturMax;
	}
	
	public function setEinsatzgebiet($gebiet) {
		if(is_array($gebiet)){
			$this->_einsatzgebiet = $gebiet;
		}
		else {
			$this->_einsatzgebiet[] = $gebiet;
		}
		return $this;
	}
	
	public function getEinsatzgebiet() {
		return $this->_einsatzgebiet;
	}
}

