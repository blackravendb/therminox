<?php

class Application_Model_DbTable_Rechnungsadresse extends Zend_Db_Table_Abstract
{

    protected $_name = 'rechnungsadresse';
    protected $_primary = 'id';
    
    protected $_dependentTables = array('Benutzer', 'Anrede');

}

