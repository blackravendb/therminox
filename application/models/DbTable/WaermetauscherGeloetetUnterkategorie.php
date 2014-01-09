<?php

class Application_Model_DbTable_WaermetauscherGeloetetUnterkategorie extends Zend_Db_Table_Abstract {

    protected $_name = 'waermetauscherGeloetetUnterkategorie';
    protected $_primary = 'id';
    
    protected $_dependentTable = array('waermetauscherGeloetet');
    
    protected $_referenceMap    = array(
    		'waermetauscherGeloetet_waermetauscherGeloetetUnterkategorie' => array(
    				'columns'           => 'waermetauscherGeloetet_id',
    				'refTableClass'     => 'Application_Model_DbTable_WaermetauscherGeloetet',
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

