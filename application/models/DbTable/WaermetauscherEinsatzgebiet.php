<?php

class Application_Model_DbTable_WaermetauscherEinsatzgebiet extends Zend_Db_Table_Abstract
{

    protected $_name = 'waermetauscherEinsatzgebiet';
    
    protected $_primary = 'id';

    protected $_dependentTables = array('Application_Model_DbTable_Waermetauscher2waermetauscherEinsatzgebiet');
    
    protected $select;
    
    public function getIdByEinsatzgebiet(Application_Model_WaermetauscherEinsatzgebiet $einsatzgebiet) {
    	$where = $this->getAdapter()->quoteInto('einsatzgebiet = ?', $einsatzgebiet->getEinsatzgebiet());
    	
    	$this->select = $this->select()
    	->from ($_name, 'id')
    	->where('$where');
    	
    	$data = $this->fetchRow($this->select);
    	$ret = $data->toArray();
    	return 	$ret['id'];							//TODO möglicherweise anderer Return wert
    }
}

