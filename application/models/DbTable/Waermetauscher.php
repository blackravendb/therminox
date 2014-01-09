<?php

class Application_Model_DbTable_Waermetauscher extends Zend_Db_Table_Abstract
{

    protected $_name = 'waermetauscher';
    protected $_primary = 'id';
    
    protected $_dependentTables = array('Application_Model_DbTable_Waermetauscher2waermetauscherEinsatzgebiet', 
    									'Application_Model_DbTable_Waermetauscher2waermetauscherAnschluss',
    									'Application_Model_DbTable_Artikelnummer',
    									'Application_Model_DbTable_WaermetauscherUnterkategorie');
    
    protected $_referenceMap    = array(
    		'stutzenmaterial' => array(
    				'columns'           => array('stutzenmaterial_id'),
    				'refTableClass'     => 'Application_Model_DbTable_Stutzenmaterial',
    				'refColumns'        => array('id'),
    				'onDelete'			=> 'self::RESTRICT',
    				'onUpdate'			=> 'self::RESTRICT'
    		),
    );
    
    protected $select;
    
    protected $produktberater;
    
    protected function initProduktberater() {
    	$this->select = $this->select();
    	//!!Nur Wärmetauscher ID abfragen!!
    	$this->select
    		->from(array('wt' => $this->_name), 'wt.id')
    		->group ('id')
    		->setIntegrityCheck(false);    

    	$this->produktberater = true;
    }
    
    public function init() {
    	$this->select = $this->select()
    	->setIntegrityCheck(false);
    	
    	$this->produktberater = false;
    }
    
    public function getWaermetauscherByParams($params) {
    	//fals zuvor ein Setter aufgerufen wurde ohne getWaermetauscher danach aufzurufen
    	$this->init();
    	$this->select
    	->from(array('wt' => $this->_name))
    	->join(array('sm' => 'stutzenmaterial'), "wt.stutzenmaterial_id = sm.id", array('name as stutzenmaterial'))
    	->join(array('an' => 'artikelnummer'),'wt.id = an.waermetauscher_id', 'an.id as artikelnummer');
    	
    	foreach($params as $key => $value){
    		$this->select
    		->where("wt.$key = ?", $value);
    	}
		
    	$data = parent::fetchAll($this->select);
    	
    	//Select Befehl wieder zurücksetzen
    	$this->init();
    	
    	if(empty($data))
    		return;
    	
    	
    	$ret = array();
    	//Dazugehörige Tabellen herausfiltern
    	foreach($data as $row) {
    		//Unterkategorien abfragen
    		$wtUnterkategorien = $row->findDependentRowset('Application_Model_DbTable_WaermetauscherUnterkategorie','waermetauscher');
    		
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
    	if(!$this->produktberater)
    		$this->initProduktberater();
    	
    	 $this->select
    	 ->where('wt.temperatur >= ?', $temp);
    }
    
    public function setTemperaturMax($temp) {
    	if(!$this->produktberater)
    		$this->initProduktberater();
    	
    	$this->select
    	->where('wt.temperatur <= ?', $temp);
    }
    
    public function setHoeheMin($hoehe) {
    	if(!$this->produktberater)
    		$this->initProduktberater();
    	
    	$this->select
    	->where('wt.hoehe >= ?', $hoehe);
    }
    
    public function setHoeheMax($hoehe) {
    	if(!$this->produktberater)
    		$this->initProduktberater();
    	
    	$this->select
    	->where('wt.hoehe <= ?', $hoehe);
    }
    
    public function setBreiteMin($breite) {
    	if(!$this->produktberater)
    		$this->initProduktberater();
    	
    	$this->select
    	->where('wt.breite >= ?', $breite);
    }
    
    public function setBreiteMax($breite) {
    	if(!$this->produktberater)
    		$this->initProduktberater();
    	
    	$this->select
    	->where("wt.breite <= ?", $breite);
    }
    
    public function setEinsatzgebiet($gebiet) {
    	if(!$this->produktberater)
    		$this->initProduktberater();
    	
    	$this->select
    	->join(array('wt2wtE' => 'waermetauscher2waermetauscherEinsatzgebiet'), 'wt.id = wt2wtE.waermetauscher_id', '')
    	->join(array('wtE' => 'waermetauscherEinsatzgebiet'), 'wtE.id = wt2wtE.waermetauscherEinsatzgebiet_id', '') //einsatzgebiet
    	->where('wtE.einsatzgebiet = ?', $gebiet);
    }
    
    public function setAnschluss($anschluss) {
    	if(!$this->produktberater)
    		$this->initProduktberater();
    	
    	$this->select
    	->join(array('wt2wtA' => 'waermetauscher2waermetauscherAnschluss'), 'wt.id = wt2wtA.waermetauscher_id', '')
    	->join(array('wtA' => 'waermetauscherAnschluss'), 'wtA.id = wt2wtA.waermetauscherAnschluss_id', '') //anschluss
		->where ('wtA.anschluss in (?)', $anschluss);
    }
    
    
    
    
    public function getWaermetauscher() {
    	if(!$this->produktberater)
    		$this->initProduktberater();
    	//Modelle filtern
    	$models = parent::fetchAll($this->select);
    	
    	//select zurücksetzen
    	$this->init();
    	
    	$products = array();
    	
    	foreach($models->toArray() as $value){
    		$productData = $this->getWaermetauscherByParams($value);
    		if(!empty($productData))
    			$products[] = $productData[0];
    	}
    	
    	return $products;
    }
    
    public function getModelList() {
    	$this->init();
    	$this->select
    	->from($this->_name,'model');
    	
    	$data = parent::fetchAll($this->select);
    	$this->init();
    	return $data->toArray();
    }
    
    public function getAnschlussListe() {
    	$this->select = $this->select();
    	$this->select
    	->from('waermetauscherAnschluss','anschluss')
    	->setIntegrityCheck(false);
    	 
    	$data = parent::fetchAll($this->select);
    	$this->init();
    	return $data->toArray();
    }
    
    public function getEinsatzgebietListe() {
    	$this->select = $this->select();
    	$this->select
    	->from('waermetauscherEinsatzgebiet','einsatzgebiet')
    	->setIntegrityCheck(false);
    	
    	$data = parent::fetchAll($this->select);
    	$this->init();
    	return $data->toArray();
    }
    
    public function deleteWaermetauscher($id) {
    	$where = $this->getAdapter()->quoteInto('id = ?', $id);
    	return $this->delete($where);
    }
    

}

