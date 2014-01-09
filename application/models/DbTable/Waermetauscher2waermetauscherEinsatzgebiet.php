<?php

class Application_Model_DbTable_Waermetauscher2waermetauscherEinsatzgebiet extends Zend_Db_Table_Abstract
{

    protected $_name = 'waermetauscher2waermetauscherEinsatzgebiet';
    
    protected $_primary = array('waermetauscherEinsatzgebiet_id', 'waermetauscher_id');
    
    protected $_referenceMap    = array(
    		'waermetauscherEinsatzgebiet' => array(
    				'columns'           => array('waermetauscherEinsatzgebiet_id'),
    				'refTableClass'     => 'Application_Model_DbTable_WaermetauscherEinsatzgebiet',
    				'refColumns'        => array('id'),
    				'onDelete'			=> 'self::RESTRICT',
    				'onUpdate'			=> 'self::RESTRICT'
    		),
    		'waermetauscher' => array(
    				'columns'           => array('waermetauscher_id'),
    				'refTableClass'     => 'Application_Model_DbTable_Waermetauscher',
    				'refColumns'        => array('id'),
    				'onDelete'			=> 'self::CASCADE',
    				'onUpdate'			=> 'self::CASCADE'
    		)
    );


}

