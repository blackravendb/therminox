<?php

class Application_Model_Waermetauscher extends Application_Model_TableAbstract
{
	protected $_id;
	protected $_model;
	protected $_betriebsdruck;
	protected $_temperatur;
	protected $_hoehe;
	protected $_breite;
	protected $_stutzenmaterial;
	protected $_waermetauscherUnterkategorie;
	protected $_waermetauscherEinsatzgebiet;
	protected $_waermetauscherAnschluss;
	
	public function toArray() {
		return array(
				"id" => $this->_id,
				"model" => $this->_model,
				"betriebsdruck" => $this->_betriebsdruck,
				"temperatur" => $this->_temperatur,
				"hoehe" => $this->_hoehe,
				"breite" => $this->_breite,
				"stuzenmaterial" => $this->_stutzenmaterial,
				"waermetauscherUnterkategorie" => $this->_waermetauscherUnterkategorie,
				"waermetauscherEinsatzgebiet" => $his->_waermetauscherEinsatzgebiet,
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
	
	public function setModel($model) {
		if($model == "")
			return false;
		
		$this->_model = $model;
	}
	
	public function getModel () {
		return $this->_model;
	}
	
	public function setBetriebsdruck($druck) {
		if($druck == "")
			return false;
	
		$this->_betriebsdruck = $druck;
	}
	
	public function getBetriebsdruck () {
		return $this->_betriebsdruck;
	}
	
	public function setTemperatur($temperatur) {
		if($temperatur == "")
			return false;
	
		$this->_temperatur = $temperatur;
	}
	
	public function getTemperatur () {
		return $this->_temperatur;
	}
	
	public function setHoehe($hoehe) {
		if($hoehe == "")
			return false;
	
		$this->_hoehe = $hoehe;
	}
	
	public function getHoehe () {
		return $this->_hoehe;
	}
	
	public function setBreite($breite) {
		if($breite == "")
			return false;
	
		$this->_breite = $breite;
	}
	
	public function getBreite () {
		return $this->_breite;
	}
	
	public function setStutzenmaterial($material) {
		if($material == "")
			return false;
	
		$this->_stutzenmaterial = $material;
	}
	
	public function getStutzenmaterial () {
		return $this->_stutzenmaterial;
	}
	
	public function setWaermetauscherUnterkategorie($wtUnterkategorie){
		if(is_array($wtUnterkategorie))
			$this->_waermetauscherUnterkategorie = $wtUnterkategorie;
		else
			$this->_waermetauscherUnterkategorie[] = $wtUnterkategorie;
	}
	
	public function getWaermetauscherUnterkategorie(){
		return $this->_waermetauscherUnterkategorie;
	}
	
	public function setWaermetauscherEinsatzgebiet($einsatzgebiet) {
		if(is_array($einsatzgebiet))
			$this->_waermetauscherEinsatzgebiet = $einsatzgebiet;
		else
			$this->_waermetauscherEinsatzgebiet[] = $einsatzgebiet;
	}
	
	public function getWaermetauscherEinsatzgebiet() {
		return $this->_waermetauscherEinsatzgebiet;
	}
	
	public function setWaermetauscherAnschluss($anschluss) {
		if(is_array($anschluss))
			$this->_waermetauscherAnschluss = $anschluss;
		else
			$this->_waermetauscherAnschluss[] = $anschluss;
	}
	
	public function getWaermetauscherAnschluss() {
		return $this->_waermetauscherAnschluss;
	}
	
	
	
	
}

