<?php

class Application_Model_WaermetauscherUnterkategorie extends Application_Model_TableAbstract
{
	protected $_id;
	protected $_waermetauscher_id;
	protected $_platten;
	protected $_laenge;
	protected $_leergewicht;
	protected $_flaeche;
	protected $_inhaltPrimaer;
	protected $_inhaltSekundaer;

	public function toArray() {
		return array(
				"id" => $this->_id,
				"waermetauscher_id" => $this->_waermetauscher_id,
				"platten" => $this->_platten,
				"laenge" => $this->_laenge,
				"leergewicht" => $this->_leergewicht,
				"flaeche" => $this->_flaeche,
				"inhaltPrimaer" => $this->_inhaltPrimaer,
				"inhaltSekundaer" => $this->_inhaltSekundaer
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
	
	public function setWaermetauscher_id($id) {
		if($id == "")
			return false;

		$this->_waermetauscher_id = (int)$id;
		return $this;
	}
	
	public function getWaermetauscher_id() {
		return $this->_waermetauscher_id;
	}
	
	public function setPlatten($platten){
		if($platten == ""){
			return false;
		}
		
		$this->_platten = $platten;
		return $this;
	}
	
	public function getPlatten() {
		return $this->_platten;
	}
	
	public function setLaenge($laenge) {
		$this->_laenge = $laenge;
	}
	
	public function getLaenge() {
		return $this->_laenge;
	}
	
	public function setLeergewicht($gewicht){
		if($gewicht == ""){
			return false;
		}
	
		$this->_leergewicht = $gewicht;
		return $this;
	}
	
	public function getLeergewicht() {
		return $this->_leergewicht;
	}
	
	public function setFlaeche($flaeche){
		if($flaeche == ""){
			return false;
		}
	
		$this->_flaeche = $flaeche;
		return $this;
	}
	
	public function getFlaeche() {
		return $this->_flaeche;
	}
	
	public function setInhaltPrimaer($inhalt){
		//Wert darf NULL sein
		
		$this->_inhaltPrimaer = $inhalt;
		return $this;
	}
	
	public function getInhaltPrimaer() {
		return $this->_inhaltPrimaer;
	}
	
	public function setInhaltSekundaer($inhalt){
		//Wert darf NULL sein
	
		$this->_inhaltSekundaer = $inhalt;
		return $this;
	}
	
	public function getInhaltSekundaer() {
		return $this->_inhaltSekundaer;
	}
		


	
}

