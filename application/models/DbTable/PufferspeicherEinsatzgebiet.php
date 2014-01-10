<?php

class Application_Model_DbTable_PufferspeicherEinsatzgebiet extends Zend_Db_Table_Abstract
{

    protected $_name = 'pufferspeicherEinsatzgebiet';
    protected $_primary = 'id';
    
    protected $_dependentTables = array('Application_Model_DbTable_Pufferspeicher2pufferspeicherEinsatzgebiet');
    
    protected $select;
    
    public function init() {
    	$this->select = $this->select()
    		->from($this->_name);
    }
    
    public function getIdByEinsatzgebiet($einsatzgebiet) {
    	$this->select
    		->where('einsatzgebiet = ?',$einsatzgebiet);
    	
    	$data = $this->fetchRow($this->select);
    	
    	$this->init();
    	
    	$data = $data->toArray();
    	
    	return $data['id'];
    }
    
}

