<?php

class Application_Model_DbTable_WaermetauscherUnterkategorie extends Zend_Db_Table_Abstract {

    protected $_name = 'waermetauscherUnterkategorie';
    protected $_primary = 'id';
    
    protected $_dependentTable = array('waermetauscher');
    
    protected $_referenceMap    = array(
    		'waermetauscher' => array(
    				'columns'           => array('waermetauscher_id'),
    				'refTableClass'     => 'Application_Model_DbTable_Waermetauscher',
    				'refColumns'        => array('id'),
    				'onDelete'			=> 'self::CASCADE',
    				'onUpdate'			=> 'self::CASCADE'
    		)
    );

    protected $select;
    
    public function init() {
    	$this->select = $this->select()
    	->setIntegrityCheck(false);
    }
    
    
}

