<?php

class Application_Model_DbTable_Angebotskorb extends Zend_Db_Table_Abstract
{

    protected $_name = 'angebotskorb';

    protected $select;
    protected $angebotDbTable;
    
    
    public function init() { 
    	$this->select = $this->select()
    		->from($this->_name);
    }
    
    protected function getAngebotDbTable() {
    	if(empty($this->angebotDbTable)){
    		$this->angebotDbTable = new Application_Model_DbTable_Angebot();
    	}
    	return $this->angebotDbTable;
    	}

    public function getAngebotskorbByEmail($email) {
    	$angebotskoerbe = parent::fetchAll($this->select);
    	
    	if(empty($angebotskoerbe)){
    		return;
    	}
    	
    	$ret = array();
    	
    	foreach($angebotskoerbe as $value){
    		$angebotskorbData = $value->toArray();
    		$angebote=$this->getAngebotDbTable()->getAngebotByAngebotskorbId($angebotskorbData['id']);
    		
    		$ret[] = array($angebotskorbData, $angebote);
    	}
    	
    	return $ret;
    }
}

