<?php

class Application_Model_DbTable_Benutzer extends Zend_Db_Table_Abstract
{

    protected $_name = 'benutzer';
    protected $_primary = 'email';
    
    protected $_dependentTables = array('Anrede');
    
    protected $select;
    
    public function init()
    {
    	$this->select = $this->select()
    	->setIntegrityCheck(false);
    }
    
    public function getBenutzer($email){
    	$this->select
       ->from('benutzer')
    	->join('anrede', 'benutzer.anrede_id = anrede.id')
    	->where('email = ?', $email);
    	
    	 $data = $this->fetchRow($this->select);
    	 
    	 //Select Befehl wieder zurücksetzen
    	 $this->init();
    	 return $data->toArray();
    }
    
    public function fetchAll(){
    	$this->select
       ->from('benutzer')
    	->join('anrede', 'benutzer.anrede_id = anrede.id');
    	
    	$data = parent::fetchAll($this->select);
    	//Select Befehl wieder zurücksetzen
    	$this->init();
    	return $data ->toArray();
    }
    
    
}

