<?php

class Application_Model_DbTable_PufferspeicherEinsatzgebiet extends Zend_Db_Table_Abstract
{

    protected $_name = 'pufferspeicherEinsatzgebiet';
    protected $_primary = 'id';
    
    protected $_dependentTables = array('Application_Model_DbTable_Pufferspeicher2pufferspeicherEinsatzgebiet');
    
}

