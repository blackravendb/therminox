<?php

class Application_Model_DbTable_WaermetauscherGeloetet extends Zend_Db_Table_Abstract
{

    protected $_name = 'waermetauscherGeloetet';
    protected $_primary = 'id';
    
    protected $_dependentTable = array('Stutzenmaterial', 'Application_Model_DbTable_WaermetauscherGeloetetUnterkategorie');
    
    protected $select;
    
    public function init() {
    	$this->select = $this->select()
    	->setIntegrityCheck(false);
    }
    
    public function getWaermetauscherGeloetet($params){
    	$this->select
    	->from($this->_name)
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
    	//Dazugehörige waermetauscherGeloetetUnterkategorie herausfiltern
    	foreach($data as $row){
    		$wtUnterkategorien = $row->findDependentRowset('Application_Model_DbTable_WaermetauscherGeloetetUnterkategorie','waermetauscherGeloetet_waermetauscherGeloetetUnterkategorie');
    		$ret[] = array($row -> toArray(), $wtUnterkategorien -> toArray());
    	}
    	
    	//print_r($ret);
    	return $ret;		
    }

}

