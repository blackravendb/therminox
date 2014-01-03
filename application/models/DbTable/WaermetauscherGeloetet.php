<?php

class Application_Model_DbTable_WaermetauscherGeloetet extends Zend_Db_Table_Abstract
{

    protected $_name = 'waermetauscherGeloetet';
    protected $_primary = 'id';
    
    protected $_dependentTable = array('Stutzenmaterial');
    
    protected $_referenceMap    = array(
    		'Benutzer_Lieferadresse' => array(
    				'columns'           => 'id',
    				'refTableClass'     => 'Application_Model_DbTable_blub',
    				'refColumns'        => 'blub_blub',
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

