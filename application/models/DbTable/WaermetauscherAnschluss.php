<?php

class Application_Model_DbTable_WaermetauscherAnschluss extends Zend_Db_Table_Abstract
{

    protected $_name = 'waermetauscherAnschluss';
	
    protected $_primary = 'id';
    
    protected $_dependentTables = array('Application_Model_DbTable_Waermetauscher2waermetauscherAnschluss');

}

