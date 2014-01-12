<?php

class Application_Model_DbTable_WaermetauscherAnschluss extends Zend_Db_Table_Abstract
{

    protected $_name = 'waermetauscherAnschluss';
	
    protected $_primary = 'id';
    
    protected $_dependentTables = array('Application_Model_DbTable_Waermetauscher2waermetauscherAnschluss');

    protected $select;
    
    public function getIdByAnschluss(Application_Model_WaermetauscherAnschluss $anschluss) {
    	$where = $this->getAdapter()->quoteInto('anschluss = ?', $anschluss->getAnschluss());
    	
    	$this->select = $this->select();
    	$this->select
    		->from($this->_name, 'id')
    		->where($where);
    	
    	$data = $this->fetchRow($this->select);
    	
    	if(empty($data))
    		return false;
    	
    	$ret = $data->toArray();
    	
    	return $ret['id'];		//möglicherweise anderer return wert
    }
}

