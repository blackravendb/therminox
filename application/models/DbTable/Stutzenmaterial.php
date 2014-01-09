	<?php

class Application_Model_DbTable_Stutzenmaterial extends Zend_Db_Table_Abstract
{

    protected $_name = 'stutzenmaterial';
    protected $_primary = 'id';
    
    protected $_dependentTables = array('Application_Model_DbTable_Waermetauscher');


}

