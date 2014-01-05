<?php

class Application_Model_DbTable_Waermetauscher2waermetauscherAnschluss extends Zend_Db_Table_Abstract
{

    protected $_name = 'waermetauscher2waermetauscherAnschluss';
    protected $_primary = array('waermetauscherAnschluss_id', 'waermetauscher_id');
    
    protected $_referenceMap    = array(
    		'waermetauscher' => array(
    				'columns'           => array('waermetauscher_id'),
    				'refTableClass'     => 'Application_Model_DbTable_Waermetauscher',
    				'refColumns'        => array('id')
    		),
    		'waermetauscherGelotetAnschluss' => array(
    				'columns'           => array('waermetauscherAnschluss_id'),
    				'refTableClass'     => 'Application_Model_DbTable_WaermetauscherAnschluss',
    				'refColumns'        => array('id')
    		)
    );


}

