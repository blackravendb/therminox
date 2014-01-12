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
	
	public function isEqual(Application_Model_WaermetauscherUnterkategorie $wtUnterkategorie) {
		$wtUnterkategorieData = $wtUnterkategorie->toArray();
		
		if($this->_platten === $wtUnterkategorieData['platten'] && $this->_laenge === $wtUnterkategorieData['laenge'] &&
		$this->_leergewicht === $wtUnterkategorieData['leergewicht'] && $this->_flaeche === $wtUnterkategorieData['flaeche'] &&
		$this->_inhaltPrimaer === $wtUnterkategorieData['inhaltPrimaer'] && $this->_inhaltSekundaer === $wtUnterkategorieData['inhaltSekundaer'])
			return true;
		
		return false;
	}
	
	//Primary Key protected function, benötig außerdem kein Zugriff auf _changed
	protected function setId ($id){
		$this->_id = (int)$id;
		return $this;
	}
	
	public function getId (){
		return $this->_id;
	}
	
	protected function setWaermetauscher_id($id) {
		$this->_waermetauscher_id = (int)$id;
		return $this;
	}
	
	public function getWaermetauscher_id() {
		return $this->_waermetauscher_id;
	}
	
	public function setPlatten($platten) {
		if($this->_platten !== $platten){
			$this->_platten = $platten;
			$this->_changed['platten'] = 1;
		}
		return $this;
	}
	
	public function getPlatten() {
		return $this->_platten;
	}
	
	public function setLaenge($laenge) {
		if($this->_laenge !== $laenge) {
			$this->_laenge = $laenge;
			$this->_changed['laenge'] = 1;
		}
		return $this;
	}
	
	public function getLaenge() {
		return $this->_laenge;
	}
	
	public function setLeergewicht($gewicht){
		if($this->_leergewicht !== $gewicht) {
			$this->_leergewicht = $gewicht;
			$this->_changed['leergewicht'] = 1;
		}
		return $this;
	}
	
	public function getLeergewicht() {
		return $this->_leergewicht;
	}
	
	public function setFlaeche($flaeche){
		if($this->_flaeche !== $flaeche) {
			$this->_flaeche = $flaeche;
			$this->_changed['flaeche'] = 1;
		}
		return $this;
	}
	
	public function getFlaeche() {
		return $this->_flaeche;
	}
	
	public function setInhaltPrimaer($inhalt){
		//Wert darf NULL sein
		if($this->_inhaltPrimaer !== $inhalt) {
			$this->_inhaltPrimaer = $inhalt;
			$this->_changed['inhaltPrimaer'] = 1;
		}
		return $this;
	}
	
	public function getInhaltPrimaer() {
		return $this->_inhaltPrimaer;
	}
	
	public function setInhaltSekundaer($inhalt){
		//Wert darf NULL sein
		if($this->_inhaltSekundaer !== $inhalt) {
			$this->_inhaltSekundaer = $inhalt;
			$this->_changed['inhaltSekundaer'] = 1;
		}
		return $this;
	}
	
	public function getInhaltSekundaer() {
		return $this->_inhaltSekundaer;
	}
	
}

