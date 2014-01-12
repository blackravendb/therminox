<?php

class Application_Model_Waermetauscher extends Application_Model_TableAbstract
{
	protected $_id;
	protected $_artikelnummer;
	protected $_model;
	protected $_betriebsdruck;
	protected $_temperatur;
	protected $_hoehe;
	protected $_breite;
	protected $_stutzenmaterial;
	protected $_waermetauscherUnterkategorie;
	protected $_waermetauscherEinsatzgebiet;
	protected $_waermetauscherAnschluss;
	
	protected $waermetauscherUnterkategorie2delete;
	
	public function toArray() {
		return array(
				"id" => $this->_id,
				"artikelnummer" => $this->_artikelnummer,
				"model" => $this->_model,
				"betriebsdruck" => $this->_betriebsdruck,
				"temperatur" => $this->_temperatur,
				"hoehe" => $this->_hoehe,
				"breite" => $this->_breite,
				"stutzenmaterial" => $this->_stutzenmaterial,
				"waermetauscherUnterkategorie" => $this->_waermetauscherUnterkategorie,
				"waermetauscherEinsatzgebiet" => $this->_waermetauscherEinsatzgebiet,
				"waermetauscherAnschluss" => $this->_waermetauscherAnschluss
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
	
	protected function setArtikelnummer($id) {
		$this->_artikelnummer = $id;
		return $this;
	}
	
	public function getArtikelnummer() {
		return $this->_artikelnummer;
	}
	
	public function setModel($model) {
		$this->_model = $model;
		$this->_changed['model'] = 1;
	}
	
	public function getModel () {
		return $this->_model;
	}
	
	public function setBetriebsdruck($druck) {
		$this->_betriebsdruck = $druck;
		$this->_changed['betriebsdruck'] = 1;
	}
	
	public function getBetriebsdruck () {
		return $this->_betriebsdruck;
	}
	
	public function setTemperatur($temperatur) {
		$this->_temperatur = $temperatur;
		$this->_changed['temperatur'] = 1;
	}
	
	public function getTemperatur () {
		return $this->_temperatur;
	}
	
	public function setHoehe($hoehe) {
		$this->_hoehe = $hoehe;
		$this->_changed['hoehe'] = 1;
	}
	
	public function getHoehe () {
		return $this->_hoehe;
	}
	
	public function setBreite($breite) {
		$this->_breite = $breite;
		$this->_changed['breite'] = 1;
	}
	
	public function getBreite () {
		return $this->_breite;
	}
	
	public function setStutzenmaterial($material) {
		$this->_stutzenmaterial = $material;
		$this->_changed['stutzenmaterial'] = 1;
	}
	
	public function getStutzenmaterial () {
		return $this->_stutzenmaterial;
	}
	
	public function getWaermetauscherUnterkategorie2delete() {
		return $this->waermetauscherUnterkategorie2delete;
	}
	
	protected function setWaermetauscherUnterkategorie($wtUnterkategorie) {
		$this->_waermetauscherUnterkategorie = $wtUnterkategorie;
	}
	
	public function insertWaermetauscherUnterkategorie(Application_Model_WaermetauscherUnterkategorie $wtUnterkategorie) {
		$enthalten = false;
		
		//Noch kein Wert gesetzt, Array anlegen und Wert zuweisen
		if(empty($this->_waermetauscherUnterkategorie)){
			$this->_waermetauscherUnterkategorie = array($wtUnterkategorie);
			$this->_changed['waermetauscherUnterkategorie'] = 1;
			return true;
		}
		foreach($this->_waermetauscherUnterkategorie as $value){
			if($value->isEqual($wtUnterkategorie)) {
				$enthalten = true;
				break;
			}
		}
		if(!$enthalten) {
			$this->_waermetauscherUnterkategorie[] = $wtUnterkategorie;
			$this->_changed['waermetauscherUnterkategorie'] = 1;
			return true;
		}
		return false;
	}
	
	public function deleteWaermetauscherUnterkategorie(Application_Model_WaermetauscherUnterkategorie $wtUnterkategorie) {
		if(empty($this->_waermetauscherUnterkategorie) || empty($wtUnterkategorie)) {
			return false;
		}
		
		foreach($this->_waermetauscherUnterkategorie as $key => $value) {
			if($wtUnterkategorie->isEqual($value)) {
				$this->waermetauscherUnterkategorie2delete[] = $value;
				unset($this->_waermetauscherUntergebiet[$key]);
				$this->_changed['waermetauscherUnterkategorie'] = 1;
			}
		}
	}
	
	public function getWaermetauscherUnterkategorie() {
		//möglicherweise änderung, change tag setzen
		$this->_changed['waermetauscherUnterkategorie'] = 1;
		return $this->_waermetauscherUnterkategorie;
	}
	
	protected function setWaermetauscherEinsatzgebiet($einsatzgebiet) {
		$this->_waermetauscherEinsatzgebiet = $einsatzgebiet;
	}
	
	public function insertWaermetauscherEinsatzgebiet(Application_Model_WaermetauscherEinsatzgebiet $einsatzgebiet) {
		$enthalten = false;
		
		//Noch kein Wert gesetzt, Array anlegen und Wert zuweisen
		if(empty($this->_waermetauscherEinsatzgebiet)){
			$this->_waermetauscherEinsatzgebiet = array($einsatzgebiet);
			$this->_changed['waermetauscherEinsatzgebiet'] = 1;
			return true;
		}
		foreach($this->_waermetauscherEinsatzgebiet as $value){
			if($value->getEinsatzgebiet() === $einsatzgebiet->getEinsatzgebiet()) {
				$enthalten = true;
				break;
			}
		}
		if(!$enthalten) {
			$this->_waermetauscherEinsatzgebiet[] = $einsatzgebiet;
			$this->_changed['waermetauscherEinsatzgebiet'] = 1;
			return true;
		}
		return false;
	}
	
	public function deleteWaermetauscherEinsatzgebiet(Application_Model_WaermetauscherEinsatzgebiet $gebiet) {
		if(empty($this->_waermetauscherEinsatzgebiet) || empty($gebiet)){
			return false;
		}
	
		foreach($this->_waermetauscherEinsatzgebiet as $key => $value) {
			if($value->getEinsatzgebiet() === $gebiet->getEinsatzgebiet()) {
				unset($this->_waermetauscherEinsatzgebiet[$key]);
				$this->_changed['waermetauscherEinsatzgebiet'] = 1;
			}
		}
	}
	
	public function getWaermetauscherEinsatzgebiet() {
		return $this->_waermetauscherEinsatzgebiet;
	}
	
	protected function setWaermetauscherAnschluss($anschluss) {
			$this->_waermetauscherAnschluss = $anschluss;
	}
	
	public function insertWaermetauscherAnschluss(Application_Model_WaermetauscherAnschluss $anschluss) {
		$enthalten = false;
		
		//Noch kein Wert gesetzt, Array anlegen und Wert zuweisen
		if(empty($this->_waermetauscherAnschluss)){
			$this->_waermetauscherAnschluss = array($anschluss);
			$this->_changed['waermetauscherAnschluss'] = 1;
			return true;
		}
		foreach($this->_waermetauscherAnschluss as $value){
			if($value->getAnschluss() === $anschluss->getAnschluss()) {
				$enthalten = true;
				break;	
			}
		}
		if(!$enthalten) {
			$this->_waermetauscherAnschluss[] = $anschluss;
			$this->_changed['waermetauscherAnschluss'] = 1;
			return true;
		}
		return false;
	}
	
	public function deleteWaermetauscherAnschluss(Application_Model_WaermetauscherAnschluss $anschluss) {
		if(empty($this->_waermetauscherAnschluss) || empty($anschluss)){
			return false;
		}
	
		foreach($this->_waermetauscherAnschluss as $key => $value) {
			if($value->getAnschluss() === $anschluss->getAnschluss()) {
				unset($this->_waermetauscherAnschluss[$key]);
				$this->_changed['waermetauscherAnschluss'] = 1;
			}
		}
	}
	
	public function getWaermetauscherAnschluss() {
		return $this->_waermetauscherAnschluss;
	}
}

