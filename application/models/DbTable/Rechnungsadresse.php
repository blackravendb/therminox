<?php

class Application_Model_DbTable_Rechnungsadresse extends Zend_Db_Table_Abstract
{

    protected $_name = 'rechnungsadresse';
    protected $_primary = 'id';
    
    protected $_referenceMap    = array(
       		'anrede' => array(
    	  			'columns'           => array('id'),
    	    		'refTableClass'     => 'Application_Model_DbTable_Anrede',
    	    		'refColumns'        => array('anrede_id'),
    	    		'onDelete'			=> 'self::RESTRICT',
    	    		'onUpdate'			=> 'self::RESTRICT'
    		),
    		'benutzer' => array(
    				'columns'           => array('benutzer_email'),
    				'refTableClass'     => 'Application_Model_DbTable_Benutzer',
    				'refColumns'        => array('email'),
    				'onDelete'			=> 'self::RESTRICT',
    				'onUpdate'			=> 'self::RESTRICT'
    		)
    );

}

