<?php

class Application_Model_DbTable_WaermetauscherEinsatzgebiet extends Zend_Db_Table_Abstract
{

    protected $_name = 'waermetauscherEinsatzgebiet';
    
    protected $_primary = 'id';

    protected $_dependentTables = array('Application_Model_DbTable_Waermetauscher2waermetauscherEinsatzgebiet');
}

