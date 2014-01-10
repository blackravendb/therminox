<?php

class Application_Model_DbTable_AngebotStatus extends Zend_Db_Table_Abstract
{

    protected $_name = 'angebotStatus';
    protected $_primary = 'id';
    
    protected $select;
    
    public function init() {
    	$this->select = $this->select();
    	$this->select
    		->from($this->_name);
    }
    
    public function getIdByStatus($status) {
    	$this->select
    				->where("$this->_name.status = ?", $status);
    	
    	$data = $this->fetchRow($this->select);
    	
    	$statusData = $data->toArray();
    	
    	return $statusData['id'];
    }


}

