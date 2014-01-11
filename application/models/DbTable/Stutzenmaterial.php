	<?php

class Application_Model_DbTable_Stutzenmaterial extends Zend_Db_Table_Abstract
{

    protected $_name = 'stutzenmaterial';
    protected $_primary = 'id';
    
    protected $_dependentTables = array('Application_Model_DbTable_Waermetauscher');
    
    protected $select;
    
    public function getIdByStutzenmaterial($stutzenmaterial) {
    	$where = $this->getAdapter()->quoteInto('name = ?', $stutzenmaterial);
    	
    	$this->select = $this->select()
    		->from($this->_name, 'id')
    		->where($where);
    	
    	$data = $this->fetchRow($this->select);
    	$ret = $data->toArray();
    	
    	return $ret['id'];		//TODO möglicherweise anderer return wert
    }


}

