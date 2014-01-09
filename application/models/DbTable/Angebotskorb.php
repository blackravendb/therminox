<?php

class Application_Model_DbTable_Angebotskorb extends Zend_Db_Table_Abstract
{

    protected $_name = 'angebotskorb';
    protected $_primary = 'id';
    
    protected $_dependentTables = array('Application_Model_DbTable_Angebot');
    
    
    protected $_referenceMap    = array(
    		'benutzer' => array(
    				'columns'           => array('benutzer_email'),
    				'refTableClass'     => 'Application_Model_DbTable_Benutzer',
    				'refColumns'        => array('email'),
    				'onDelete'			=> 'self::CASCADE',
    				'onUpdate'			=> 'self::CASCADE'
    
    		)
    );

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

