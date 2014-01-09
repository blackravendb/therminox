<?php

class Application_Model_DbTable_Pufferspeicher extends Zend_Db_Table_Abstract
{

    protected $_name = 'pufferspeicher';
    protected $_primary = 'id';
    
    protected $_dependentTables = array('Application_Model_DbTable_Pufferspeicher2pufferspeicherEinsatzgebiet',
    									'Application_Model_DbTable_Artikelnummer');

    protected $select;
    
    public function init() {
    	$this->select = $this->select()
    		->from($this->_name)
    		->join('artikelnummer','pufferspeicher.id = artikelnummer.pufferspeicher_id', 'artikelnummer.id as artikelnummer')
    		->setIntegrityCheck(false);
    }

    public function getPufferspeicherByParams($params){
    	$this->init();
    	
    	foreach($params as $key => $value) {
    		$this->select
    		->where("pufferspeicher.$key = ?", $value);
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

