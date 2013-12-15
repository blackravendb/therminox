<?php

class Application_Model_DbTable_Anrede extends Zend_Db_Table_Abstract
{
	
    protected $_name = 'anrede';
    protected $_primary = 'id';

    protected $_dependentTables = array('Benutzer');
    
    protected $_referenceMap    = array(
    		'Anreden' => array(
    				'columns'           => 'id',
    				'refTableClass'     => 'Application_Model_DbTable_Benutzer',
    				'refColumns'        => 'anrede_id',
    				'onDelete'			=> 'self::RESTRICT',
    				'onUpdate'			=> 'self::RESTRICT'
    		)
    );
    
}

