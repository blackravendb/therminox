<?php

class Application_Model_DbTable_WaermetauscherUnterkategorie extends Zend_Db_Table_Abstract {

    protected $_name = 'waermetauscherUnterkategorie';
    protected $_primary = 'id';
    
    protected $_dependentTable = array('waermetauscher');
    
    protected $_referenceMap    = array(
    		'waermetauscher_waermetauscherUnterkategorie' => array(
    				'columns'           => 'waermetauscher_id',
    				'refTableClass'     => 'Application_Model_DbTable_Waermetauscher',
    				'refColumns'        => 'id',
    				'onDelete'			=> 'self::RESTRICT',
    				'onUpdate'			=> 'self::RESTRICT'
    		)
    );

    protected $select;
    
    public function init() {
    	$this->select = $this->select()
    	->setIntegrityCheck(false);
    }
    
    
}

