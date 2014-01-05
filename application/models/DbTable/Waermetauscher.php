<?php

class Application_Model_DbTable_Waermetauscher extends Zend_Db_Table_Abstract
{

    protected $_name = 'waermetauscher';
    protected $_primary = 'id';
    
    protected $_dependentTables = array('Application_Model_DbTable_Waermetauscher2waermetauscherAnschluss');
    
    protected $select;
    
    public function init() {
    	$this->select = $this->select()
    	->from($this->_name)
    	->group ('model')
    	->setIntegrityCheck(false);
    }
    
    public function getWaermetauscherByParams($params) {
    	//fals zuvor ein Setter aufgerufen wurde ohne getWaermetauscher danach aufzurufen
    	$this->init();
    	
    	$this->select
    	->join('stutzenmaterial', "$this->_name.stutzenmaterial_id = stutzenmaterial.id", array('name as stutzenmaterial'));
    	
    	foreach($params as $key => $value){
    		$this->select
    		->where("$key = ?", $value);
    	}
		
    	$data = parent::fetchAll($this->select);
    	
    	//Select Befehl wieder zurücksetzen
    	$this->init();
    	
    	if(count($data) == 0)
    		return false;
    	
    	
    	$ret = array();
    	//Dazugehörige Tabellen herausfiltern
    	foreach($data as $row){
    		//Unterkategorien abfragen
    		$wtUnterkategorien = $row->findDependentRowset('Application_Model_DbTable_WaermetauscherUnterkategorie','waermetauscher_waermetauscherUnterkategorie');
    		
    		//Anschlussarten abfragen
    		$wtAnschluss = $row->findManyToManyRowset('Application_Model_DbTable_WaermetauscherAnschluss','Application_Model_DbTable_Waermetauscher2waermetauscherAnschluss');
    		
    		
    		//Einsatzgebiete abfragen
    		$wtEinsatzgebiet = $row->findManyToManyRowset('Application_Model_DbTable_WaermetauscherEinsatzgebiet','Application_Model_DbTable_Waermetauscher2waermetauscherEinsatzgebiet');
    		
    		//Alles in einem Array verpacken zum returnen
    		$ret[] = array($row -> toArray(), $wtUnterkategorien -> toArray(), $wtAnschluss -> toArray(), $wtEinsatzgebiet -> toArray());
    	}
    	
    	
    	return $ret;		
    }
    
    //Setter für Produktberater

    public function setTemperaturMin($temp) {
    	 $this->select
    	 ->where('temperatur >= ?', $temp);
    }
    
    public function setTemperaturMax($temp) {
    	$this->select
    	->where('temperatur <= ?', $temp);
    }
    
    public function setHoeheMin($hoehe) {
    	$this->select
    	->where('hoehe >= ?', $hoehe);
    }
    
    public function setHoeheMax($hoehe) {
    	$this->select
    	->where('hoehe <= ?', $hoehe);
    }
    
    public function setBreiteMin($breite) {
    	$this->select
    	->where('breite >= ?', $breite);
    }
    
    public function setBreiteMax($breite) {
    	$this->select
    	->where('breite <= ?', $breite);
    }
    
    public function setEinsatzgebiet($gebiet) {
    	$this->select
    	->join('waermetauscher2waermetauscherEinsatzgebiet', 'waermetauscher.id = waermetauscher2waermetauscherEinsatzgebiet.waermetauscher_id','')
    	->join('waermetauscherEinsatzgebiet', 'waermetauscherEinsatzgebiet.id = waermetauscher2waermetauscherEinsatzgebiet.waermetauscherEinsatzgebiet_id', '') //einsatzgebiet
    	->where('einsatzgebiet = ?', $gebiet);
    }
    
    public function setAnschluss($anschluss) {
    	$this->select
    	->join('waermetauscher2waermetauscherAnschluss', 'waermetauscher.id=waermetauscher2waermetauscherAnschluss.waermetauscher_id','')
    	->join('waermetauscherAnschluss', 'waermetauscherAnschluss.id = waermetauscher2waermetauscherAnschluss.waermetauscherAnschluss_id','') //anschluss
		->where ('anschluss in (?)', $anschluss);
    }
    
    
    
    
    public function getWaermetauscher() {
    	$models = parent::fetchAll($this->select);
    	echo $this->select;
    	//select zurücksetzen
    	$this->init();
    	$products = array();
    	return $models->toArray();
    }
    

}

