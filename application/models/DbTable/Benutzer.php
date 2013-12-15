<?php

class Application_Model_DbTable_Benutzer extends Zend_Db_Table_Abstract
{

    protected $_name = 'benutzer';
    protected $_primary = 'email';
    
    protected $_dependentTables = array('Benutzer');
    
    protected $_referenceMap    = array(
    		'Anreden' => array(
    				'columns'           => 'anrede_id',
    				'refTableClass'     => 'Application_Model_DbTable_Anrede',
    				'refColumns'        => 'id',
    				'onDelete'			=> 'self::RESTRICT',
    				'onUpdate'			=> 'self::RESTRICT'
    				)
    		);
}

