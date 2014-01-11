<?php

class Application_Model_Pufferspeicher extends Application_Model_TableAbstract {
	
	protected $_id;
	protected $_artikelnummer;
	protected $_model;
	protected $_speicherinhalt;
	protected $_leergewicht;
	protected $_betriebsdruck;
	protected $_temperaturMax;
	protected $_einsatzgebiet;
	
	protected $_einsatzgebiet2delete;
	
	public function toArray() {
		return array(
				"id" => $this->_id,
				"artikelnummer" => $this->_artikelnummer,
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
	
	protected function setArtikelnummer($id) {
		$this->_artikelnummer = (int) $id;
		return $this;
	}
	
	public function getArtikelnummer() {
		return $this->_artikelnummer;
	}
	
	public function setModel($model) {
		$this->_model = $model;
		$this->_changed['model'] = 1;
		return $this;
	}
	
	public function getModel() {
		return $this->_model;
	}
	
	public function setSpeicherinhalt($inhalt) {
		$this->_speicherinhalt = $inhalt;
		$this->_changed['speicherinhalt'] = 1;
		return $this;
	}
	
	public function getSpeicherinhalt() {
		return $this->_speicherinhalt;
	}
	
	public function setLeergewicht($gewicht) {
		$this->_leergewicht = $gewicht;
		$this->_changed['leergewicht'] = 1;
		return $this;
	}
	
	public function getLeergewicht() {
		return $this->_leergewicht;
	}
	
	public function setBetriebsdruck($druck) {
		$this->_betriebsdruck = $druck;
		$this->_changed['betriebsdruck'] = 1;
		return $this;
	}
	
	public function getBetriebsdruck() {
		return $this->_betriebsdruck;
	}
	
	public function setTemperaturMax($temp) {
		$this->_temperaturMax = $temp;
		$this->_changed['temperatur'] = 1;
		return $this;
	}
	
	public function getTemperaturMax() {
		return $this->_temperaturMax;
	}
	
	protected function setEinsatzgebiet($gebiet) {
		$this->_einsatzgebiet = $gebiet;
		return $this;
	}
	
	public function insertEinsatzgebiet(Application_Model_PufferspeicherEinsatzgebiet $gebiet) {
		$enthalten = false;
		
		//Noch kein Wert gesetzt, Array anlegen und Wert zuweisen
		if(empty($this->_einsatzgebiet)){
			$this->_einsatzgebiet = array($gebiet);
			$this->_changed['einsatzgebiet'] = 1;
			return true;
		}
		foreach($this->_einsatzgebiet as $value){
			if($value->getEinsatzgebiet() === $gebiet->getEinsatzgebiet()) {
				$enthalten = true;
				break;	
			}
		}
		if(!$enthalten) {
			$this->_einsatzgebiet[] = $gebiet;
			$this->_changed['einsatzgebiet'] = 1;
			return true;
		}
		return false;
	}
	
	public function deleteEinsatzgebiet(Application_Model_PufferspeicherEinsatzgebiet $gebiet) {
		if(empty($this->_einsatzgebiet) || empty($gebiet)){
			return false;
		}
		
		foreach($this->_einsatzgebiet as $key => $value) {
			if($value->getEinsatzgebiet() === $gebiet->getEinsatzgebiet()) {
				$this->_einsatzgebiet2delete[] = $this->_einsatzgebiet[$key];
				unset($this->_einsatzgebiet[$key]);
				$this->_changed['einsatzgebiet'] = 1;
			}
		}
	}
	
	public function getEinsatzgebiet() {
		return $this->_einsatzgebiet;
	}
	
	public function getEinsatzgebiet2delete() {
		return $this->_einsatzgebiet2delete;
	}
	
}

