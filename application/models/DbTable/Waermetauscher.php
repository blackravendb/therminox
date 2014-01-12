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
    
    protected $waermetauscherUnterkategorieDbTable;
    protected $artikelnummerDbTable;
    protected $waermetauscherEinsatzgebietDbTable;
    protected $stutzenmaterialDbTable;
    protected $waermetauscher2waermetauscherEinsatzgebietDbTable;
    protected $waermetauscherAnschlussDbTable;
    protected $waermetauscher2waermetauscherAnschlussDbTable;
    
    protected function getStutzenmaterialDbTable() {
    	if(empty($this->stutzenmaterialDbTable))
    		$this->stutzenmaterialDbTable = new Application_Model_DbTable_Stutzenmaterial();
    	
    	return $this->stutzenmaterialDbTable;
    }
    
    protected function getArtikelnummerDbTable() {
    	if(empty($this->artikelnummerDbTable))
    		$this->artikelnummerDbTable = new Application_Model_DbTable_Artikelnummer();
    	 
    	return $this->artikelnummerDbTable;
    }
    
    protected function getWaermetauscherUnterkategorieDbTable() {
    	if(empty($this->waermetauscherUnterkategorieDbTable))
    		$this->waermetauscherUnterkategorieDbTable = new Application_Model_DbTable_WaermetauscherUnterkategorie();
    	
    	return $this->waermetauscherUnterkategorieDbTable;
    }
    
    protected function getWaermetauscherEinsatzgebietDbTable() {
    	if(empty($this->waermetauscherEinsatzgebietDbTable))
    		$this->waermetauscherEinsatzgebietDbTable = new Application_Model_DbTable_WaermetauscherEinsatzgebiet();
    	
    	return $this->waermetauscherEinsatzgebietDbTable;
    }
    
    protected function getWaermetauscher2waermetauscherEinsatzgebietDbTable() {
    	if(empty($this->waermetauscher2waermetauscherEinsatzgebietDbTable))
    		$this->waermetauscher2waermetauscherEinsatzgebietDbTable = new Application_Model_DbTable_Waermetauscher2waermetauscherEinsatzgebiet();
    	
    	return $this->waermetauscher2waermetauscherEinsatzgebietDbTable;
    }
    
    protected function getWaermetauscherAnschlussDbTable() {
    	if(empty($this->waermetauscherAnschlussDbTable))
    		$this->waermetauscherAnschlussDbTable = new Application_Model_DbTable_WaermetauscherAnschluss();
    	
    	return $this->waermetauscherAnschlussDbTable;
    }
    
    protected function getWaermetauscher2waermetauscherAnschlussDbTable() {
    	if(empty($this->waermetauscher2waermetauscherAnschlussDbTable))
    		$this->waermetauscher2waermetauscherAnschlussDbTable = new Application_Model_DbTable_Waermetauscher2waermetauscherAnschluss();
    	
    	return $this->waermetauscher2waermetauscherAnschlussDbTable;
    }
    
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
    	->join(array('wtA' => 'waermetauscherAnschluss'), 'wtA.id = wt2wtA.waermetauscherAnschluss_id', '')
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
    
    public function getStutzenmaterialListe() {
    	$select = $this->select();
   		$select
   		->from('stutzenmaterial','name')
   		->setIntegrityCheck(false);
   		
   		$data = parent::fetchAll($select);
   		
   		return $data->toArray();
    }
    
    public function deleteWaermetauscher($id) {
    	$where = $this->getAdapter()->quoteInto('id = ?', $id);
    	try{
    		$this->delete($where);
    	}catch(Exception $e){
    		return false;
    	}
    	return true;
    }
    
    public function insertWaermetauscher(Application_Model_Waermetauscher $waermetauscher) {
    	$this->getAdapter()->beginTransaction();
    	
    	$waermetauscherData = $waermetauscher->toArray();
    	try {
    	//Daten zwischenspeichern
    	$wtUnterkategorie = $waermetauscherData['waermetauscherUnterkategorie'];
    	$wtEinsatzgebiet = $waermetauscherData['waermetauscherEinsatzgebiet'];
    	$wtAnschluss = $waermetauscherData['waermetauscherAnschluss'];
    	$wtStutzenmaterial = $waermetauscherData['stutzenmaterial'];
    	
    	//nicht benötigte Daten löschen
    	unset($waermetauscherData['id']);
    	unset($waermetauscherData['artikelnummer']);
    	unset($waermetauscherData['waermetauscherAnschluss']);
    	unset($waermetauscherData['waermetauscherEinsatzgebiet']);
    	unset($waermetauscherData['waermetauscherUnterkategorie']);
    	unset($waermetauscherData['stutzenmaterial']);
    	
    	//Stutzenmaterial ID ermitteln
    	$waermetauscherData['stutzenmaterial_id'] = $this->getStutzenmaterialDbTable()->getIdByStutzenmaterial($wtStutzenmaterial);
    	
    	//Wärmetauscher einfügen
    	$waermetauscherId = $this->insert($waermetauscherData);
    	
    	//Kein Primary Key, SQL statement fehlgeschlagen
    	if(empty($waermetauscherId))
    		return false;
    	
    	//Artikelnummer generieren
    	$this->getArtikelnummerDbTable()->insert(array('waermetauscher_id' => $waermetauscherId));
    	
    	//Unterkategorien einpflegen
    	if(!empty($wtUnterkategorie)) {
    		foreach($wtUnterkategorie as $value) {
    			$this->getWaermetauscherUnterkategorieDbTable()->insertWaermetauscherUnterkategorie($value, $waermetauscherId);
    		}
    	}
    	
    	//Einsatzgebiete Einpflegen
    	if(!empty($wtEinsatzgebiet)) {
    		foreach($wtEinsatzgebiet as $value) {
    			$einsatzgebietId = is_int($value->getId()) ? $value->getId() : $this->getWaermetauscherEinsatzgebietDbTable()->getIdByEinsatzgebiet($value);
    			
    			$this->getWaermetauscher2waermetauscherEinsatzgebietDbTable()->insert(array('waermetauscher_id' => $waermetauscherId, 'waermetauscherEinsatzgebiet_id' => $einsatzgebietId));
    		}
    	}
    	
    	//Anschlüsse einpflegen
    	if(!empty($wtAnschluss)) {
    		foreach($wtAnschluss as $value) {
    			$anschlussId = is_int($value->getId()) ? $value->getId() : $this->getWaermetauscherAnschlussDbTable()->getIdByAnschluss($value);
    			
    			$this->getWaermetauscher2waermetauscherAnschlussDbTable()->insert(array('waermetauscher_id' => $waermetauscherId, 'waermetauscherAnschluss_id' => $anschlussId));
    		}
    	}

    	}catch(Exception $e){
    			//TODO
    	}
    	$this->getDbAdapter()->commit();
    	return true;    	
    }
    
    public function updateWaermetauscher(Application_Model_Waermetauscher $waermetauscher) {
    	$waermetauscherData = $waermetauscher->toArray();
    	
    	foreach($waermetauscherData as $key => $value) {
    		if(!$waermetauscher->isChanged($key)) {
    			unset($waermetauscherData[$key]);
    		}
    	}
    	
    	//Stutzenmaterial wurde geändert
    	if(key_exists('stutzenmaterial', $waermetauscherData)) {
    		$waermetauscherData['stutzenmaterial_id'] = $this->getStutzenmaterialDbTable()->getIdByStutzenmaterial($waermetauscherData['stutzenmaterial']);
    		unset($waermetauscherData['stutzenmaterial']);
    	}
    	
    	//Unterkategorie wurde geändert
    	if(key_exists('waermetauscherUnterkategorie', $waermetauscherData)) {
    		foreach($waermetauscherData['waermetauscherUnterkategorie'] as $value) {
    			$this->getWaermetauscherUnterkategorieDbTable()->changeWaermetauscherUnterkategorie($value);
    		}
    		unset($waermetauscherData['waermetauscherUnterkategorie']);
    	}
    	
    	//Einsatzgebiet wurde geändert
    	if(key_exists('waermetauscherEinsatzgebiet', $waermetauscherData)) {
    		//Einsatzgebiete löschen
    		$where = $this->getAdapter()->quoteInto('waermetauscher_id = ?', $waermetauscher->getId());
    		$this->getWaermetauscher2waermetauscherEinsatzgebietDbTable()->delete($where);
    		
    		//neue Einsatzgebiete schreiben
    		foreach($waermetauscherData['waermetauscherEinsatzgebiet'] as $value) {
    			$einsatzgebietId = is_int($value->getId()) ? $value->getId() : $this->getWaermetauscherEinsatzgebietDbTable()->getIdByEinsatzgebiet($value);
    			
    			$this->getWaermetauscher2waermetauscherEinsatzgebietDbTable()->insert(array('waermetauscher_id' => $waermetauscher->getId(), 'waermetauscherEinsatzgebiet_id' => $einsatzgebietId));
    		}  		
    		unset($waermetauscherData['waermetauscherEinsatzgebiet']);
    	}
    	
    	//Anschluss wurde verändert
    	if(key_exists('waermetauscherAnschluss', $waermetauscherData)) {
    		//Anschlüsse löschen
    		$where = $this->getAdapter()->quoteInto('waermetauscher_id = ?', $waermetauscher->getId());
    		$this->getWaermetauscher2waermetauscherAnschlussDbTable()->delete($where);
    		
    		//neue Anschlüsse schreiben
    		foreach($waermetauscherData['waermetauscherAnschluss'] as $value) {
    			$anschlussId = is_int($value->getId()) ? $value->getId() : $this->getWaermetauscherAnschlussDbTable()->getIdByAnschluss($value);
    			 
    			$this->getWaermetauscher2waermetauscherAnschlussDbTable()->insert(array('waermetauscher_id' => $waermetauscher->getId(), 'waermetauscherAnschluss_id' => $anschlussId));
    		}
    		unset($waermetauscherData['waermetauscherAnschluss']);
    	}
    	
    	$where = $this->getAdapter()->quoteInto('id = ?', $waermetauscher->getId());
    	$this->update($waermetauscherData, $where);
    }
    
    public function insertStutzenmaterial($stutzenmaterial) {
    	$what = array('name' => $stutzenmaterial);
    	$this->getStutzenmaterialDbTable()->insert($what);
    }
    
    public function deleteStutzenmaterial($stutzenmaterial) {
    	$where= $this->getAdapter()->quoteInto('name = ?', $stutzenmaterial);
    	$this->getStutzenmaterialDbTable()->delete($where);
    }
    
    public function insertAnschluss($anschluss) {
    	$what = array('anschluss' => $anschluss);
    	$this->getWaermetauscherAnschlussDbTable()->insert($what);
    }
    
    public function deleteAnschluss($anschluss) {
    	$where = $this->getAdapter()->quoteInto('anschluss = ?', $anschluss);
    	$this->getWaermetauscherAnschlussDbTable()->delete($where);
    }
    
    public function insertEinsatzgebiet($einsatzgebiet) {
    	$what = array('einsatzgebiet' => $einsatzgebiet);
    	$this->getWaermetauscherEinsatzgebietDbTable()->insert($what);
    }
    
    public function deleteEinsatzgebiet($einsatzgebiet) {
    	$where = $this->getAdapter()->quoteInto('einsatzgebiet = ?', $einsatzgebiet);
    	$this->getWaermetauscherEinsatzgebietDbTable()->delete($where);
    }

}

