<?php

class Application_Model_DbTable_Pufferspeicher extends Zend_Db_Table_Abstract
{

    protected $_name = 'pufferspeicher';
    protected $_primary = 'id';
    
    protected $_dependentTables = array('Application_Model_DbTable_Pufferspeicher2pufferspeicherEinsatzgebiet',
    									'Application_Model_DbTable_Artikelnummer');

    protected $select;
    protected $produktberaterSelect;
    protected $pufferspeicher2pufferspeicherEinsatzgebietDbTable;
    protected $artikelnummerDbTable;
    
    
    public function init() {
    	$this->select = $this->select()
    		->from("$this->_name as ps")
    		->join('artikelnummer as an','ps.id = an.pufferspeicher_id', 'an.id as artikelnummer')
    		->setIntegrityCheck(false);
    	
    	$this->produktberaterSelect = $this->select()
    		->from("$this->_name as ps",'ps.id')
    		->setIntegrityCheck(false);
    }
    
    protected function getPufferspeicher2pufferspeicherEinsatzgebietDbTable() {
    	if(empty($this->pufferspeicher2pufferspeicherEinsatzgebietDbTable))
    		$this->pufferspeicher2pufferspeicherEinsatzgebietDbTable = new Application_Model_DbTable_Pufferspeicher2pufferspeicherEinsatzgebiet();
    	
    	return $this->pufferspeicher2pufferspeicherEinsatzgebietDbTable;
    }
    
    protected function getPufferspeicherEinsatzgebietDbTable(){
    	if(empty($this->pufferspeicherEinsatzgebietDbTable))
    		$this->pufferspeicherEinsatzgebietDbTable = new Application_Model_DbTable_PufferspeicherEinsatzgebiet();
    	 
    	return $this->pufferspeicherEinsatzgebietDbTable;
    }
    
    protected function getArtikelnummerDbTable() {
    	if(empty($this->artikelnummerDbTable))
    		$this->artikelnummerDbTable = new Application_Model_DbTable_Artikelnummer();
    	
    	return $this->artikelnummerDbTable;
    }

    public function getPufferspeicherByParams($params) {
    	$this->init();
    	
    	foreach($params as $key => $value) {
    		$this->select
    		->where("ps.$key = ?", $value);
    	}
    	
    	$data = parent::fetchAll($this->select);
    	
    	//Select Befehl wieder zurücksetzen
    	$this->init();
    	
    	if(empty($data))
    		return;
    	
    	$ret = array();
    	
    	foreach($data as $row) {
    		//Einsatzgebiete abfragen
    		$psEinsatzgebiete = $row->findManyToManyRowset('Application_Model_DbTable_PufferspeicherEinsatzgebiet', 'Application_Model_DbTable_Pufferspeicher2pufferspeicherEinsatzgebiet');

    		$ret[] = array($row->toArray(), $psEinsatzgebiete->toArray());
    	}
    	
    	return $ret;
    	
    }
    
	public function setEinsatzgebiet($einsatzgebiet) {
		$this->produktberaterSelect
    	->join(array('ps2psE' => 'pufferspeicher2pufferspeicherEinsatzgebiet'), 'ps.id = ps2psE.pufferspeicher_id', '')
    	->join(array('psE' => 'pufferspeicherEinsatzgebiet'), 'psE.id = ps2psE.pufferspeicherEinsatzgebiet_id', '')
    	->where('psE.einsatzgebiet = ?', $einsatzgebiet);
		
	}
	
	public function setSpeicherinhaltMin($speicherinhalt) {
		$this->produktberaterSelect
			->where('speicherinhalt > ?', (int)$speicherinhalt);
	}
	
	public function setSpeicherinhaltMax($speicherinhalt) {
		$this->produktberaterSelect
			->where('speicherinhalt < ?', (int)$speicherinhalt);
	}
	
	public function setBetriebsdruckMin($betriebsdruck) {
		$this->produktberaterSelect
			->where('betriebsdruck > ?', (int)$betriebsdruck);
	}
	
	public function setBetriebsdruckMax($betriebsdruck) {
		$this->produktberaterSelect
			->where('betriebsdruck < ?', (int)$betriebsdruck);
	}
	
	public function getPufferspeicher() {
		$ids = $this->fetchAll($this->produktberaterSelect);
		
		$ids = $ids->toArray();
		$ret = array();
		
		foreach($ids as $value){
			$data = $this->getPufferspeicherByParams(array('id' => $value['id']));
			$ret[] = $data[0];
		}
		$this->init();
		
		return $ret;
	}
    
    public function getEinsatzgebietListe() {
    	$this->select = $this->select();
    	$this->select
    	->from('pufferspeicherEinsatzgebiet','einsatzgebiet')
    	->setIntegrityCheck(false);
    	 
    	$data = parent::fetchAll($this->select);
    	$this->init();
    	return $data->toArray();
    }
    
    public function deletePufferspeicher($id) {
    	$where = $this->getAdapter()->quoteInto('id = ?', $id);
    	
    	$this->delete($where);
    }
    
    public function insertPufferspeicher(Application_Model_Pufferspeicher $pufferspeicher) {
    	$pufferspeicherData = $pufferspeicher->toArray();
    	
    	$einsatzgebiet = $pufferspeicherData['einsatzgebiet'];
    	
    	unset($pufferspeicherData['einsatzgebiet']);
    	unset($pufferspeicherData['artikelnummer']);
    	
    	//pufferspeicher einfügen und ID ermitteln
    	$pufferspeicherId = $this->insert($pufferspeicherData);
    	
    	//Artikelnummer generieren
    	$this->getArtikelnummerDbTable()->insert(array('pufferspeicher_id' => $pufferspeicherId));
    	
    	//Einsatzgebiete einfügen
    	foreach($einsatzgebiet as $value) {
    		$einsatzgebietId = $this->getPufferspeicherEinsatzgebietDbTable()->getIdByEinsatzgebiet($value->getEinsatzgebiet());
    		$this->getPufferspeicher2pufferspeicherEinsatzgebietDbTable()->insert(array('pufferspeicher_id' => $pufferspeicherId, 'pufferspeicherEinsatzgebiet_id' => $einsatzgebietId));
    	}
    }
    
    public function updatePufferspeicher(Application_Model_Pufferspeicher $pufferspeicher) {
    	$pufferspeicherData = $pufferspeicher->toArray();
    	unset($pufferspeicherData['artikelnummer']);
    	
    	//Alle Felder, die nicht verändert wurden löschen
    	foreach($pufferspeicherData as $key => $value) {
    		if(!$pufferspeicher->isChanged($key))
    			unset($pufferspeicherData[$key]);
    	}
    	


     	//Einsatzgebiete überprüfen ob was verändert wurde
    	if(key_exists('einsatzgebiet', $pufferspeicherData)) {
    		//alte Gebiete löschen
    		$where = $this->getAdapter()->quoteInto('pufferspeicher_id = ?', $pufferspeicher->getId());
    		$this->getPufferspeicher2pufferspeicherEinsatzgebietDbTable()->delete($where);
    	
    		//neue Gebiete einfügen
    		foreach($pufferspeicherData['einsatzgebiet'] as $value) {
    			$einsatzgebietId = is_int($value->getId()) ? $value->getId() : $this->getPufferspeicherEinsatzgebietDbTable()->getIdByEinsatzgebiet($value->getEinsatzgebiet());
    			$this->getPufferspeicher2pufferspeicherEinsatzgebietDbTable()->insert(array('pufferspeicher_id' => $pufferspeicher->getId(),
    																						'pufferspeicherEinsatzgebiet_id' => $einsatzgebietId));
    		}
    	unset($pufferspeicherData['einsatzgebiet']);
    	}
    	
    	$where = $this->getAdapter()->quoteInto('id = ?', $pufferspeicher->getId());
    	$this->update($pufferspeicherData, $where);
    }
    
    public function insertEinsatzgebiet($einsatzgebiet) {
    	$what = array('einsatzgebiet' => $einsatzgebiet);
    	$this->getPufferspeicherEinsatzgebietDbTable()->insert($what);
    }
    
    public function deleteEinsatzgebiet($einsatzgebiet) {
    	$where = $this->getAdapter()->quoteInto('einsatzgebiet = ?', $einsatzgebiet);
    	$this->getPufferspeicherEinsatzgebietDbTable()->delete($where);
    }

}

