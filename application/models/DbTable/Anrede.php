<?php

class Application_Model_DbTable_Anrede extends Zend_Db_Table_Abstract
{
	
    protected $_name = 'anrede';
    protected $_primary = 'id';
    
    protected $_referenceMap    = array(
    		'Anrede_Benutzer' => array(
    				'columns'           => 'id',
    				'refTableClass'     => 'Application_Model_DbTable_Benutzer',
    				'refColumns'        => 'anrede_id',
    				'onDelete'			=> 'self::RESTRICT',
    				'onUpdate'			=> 'self::RESTRICT'
    		),
    		'Anrede_Lieferadresse' => array(
    				'columns'           => 'id',
    				'refTableClass'     => 'Application_Model_DbTable_Lieferadresse',
    				'refColumns'        => 'anrede_id',
    				'onDelete'			=> 'self::RESTRICT',
    				'onUpdate'			=> 'self::RESTRICT'
    		),
    		'Anrede_Rechnungsadresse' => array(
    				'columns'           => 'id',
    				'refTableClass'     => 'Application_Model_DbTable_Rechnungsadresse',
    				'refColumns'        => 'anrede_id',
    				'onDelete'			=> 'self::RESTRICT',
    				'onUpdate'			=> 'self::RESTRICT'
    		)
    );  
    
    protected $select;
    
    public function init() {
    	$this->select = $this->select();
    }

    public function getIdByAnrede($anrede) {
    	$this->select
    		->from('anrede')
    		->where('anrede = ?', $anrede);
    	
    	$data = $this->fetchRow($this->select);
    	
    	//Select Befehl wieder zurücksetzen
    	$this->init();
    	return $data->toArray();
    }
}

