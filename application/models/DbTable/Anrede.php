<?php

class Application_Model_DbTable_Anrede extends Zend_Db_Table_Abstract
{
	
    protected $_name = 'anrede';
    protected $_primary = 'id';
    
    protected $_dependentTables = array('Application_Model_DbTable_Adresse', 'Application_Model_DbTable_Benutzer');  
    
    protected $select;
    
    public function init() {
    	$this->select = $this->select();
    }

    public function getIdByAnrede($anrede) {
    	$this->select
    		->from('anrede')
    		->where('anrede = ?', $anrede);
    	
    	$data = $this->fetchRow($this->select);
    	
    	//Select Befehl wieder zurücksetzen
    	$this->init();
    	return $data->toArray();
    }
}

