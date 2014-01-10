<?php

class Application_Model_DbTable_Pufferspeicher extends Zend_Db_Table_Abstract
{

    protected $_name = 'pufferspeicher';
    protected $_primary = 'id';
    
    protected $_dependentTables = array('Application_Model_DbTable_Pufferspeicher2pufferspeicherEinsatzgebiet',
    									'Application_Model_DbTable_Artikelnummer');

    protected $select;
    protected $produktberaterSelect;
    
    
    public function init() {
    	$this->select = $this->select()
    		->from("$this->_name as ps")
    		->join('artikelnummer as an','ps.id = an.pufferspeicher_id', 'an.id as artikelnummer')
    		->setIntegrityCheck(false);
    	
    	$this->produktberaterSelect = $this->select()
    		->from("$this->_name as ps",'ps.id')
    		->setIntegrityCheck(false);
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

}

