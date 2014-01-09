<?php

class Application_Model_DbTable_Angebot extends Zend_Db_Table_Abstract
{

    protected $_name = 'angebot';
    protected $_primary = array('angebotskorb_id', 'artikelnummer_id');
     
    protected $_referenceMap    = array(
    		'angebotskorb' => array(
    				'columns'           => array('angebotskorb_id'),
    				'refTableClass'     => 'Application_Model_DbTable_Angebotskorb',
    				'refColumns'        => array('id'),
    				'onDelete'			=> 'self::CASCADE',
    				'onUpdate'			=> 'self::CASCADE'
    		),
    		'angebotStatus' => array(
    				'columns'           => array('angebotStatus_id'),
    				'refTableClass'     => 'Application_Model_DbTable_AngebotStatus',
    				'refColumns'        => array('id'),
    				'onDelete'			=> 'self::RESTRICT',
    				'onUpdate'			=> 'self::RESTRICT'
    		),
    		'artikelnummer' => array(
    				'columns'           => array('artikelnummer_id'),
    				'refTableClass'     => 'Application_Model_DbTable_Artikelnummer',
    				'refColumns'        => array('id'),
    				'onDelete'			=> 'self::RESTRICT',
    				'onUpdate'			=> 'self::RESTRICT'
    		)
    );
    
    public function init() {
    	$this->select = $this->select()
    		->from($this->_name, array('angebotskorb_id', 'artikelnummer_id as artikelnummer'))
    		->join('angebotStatus', "$this->_name.angebotStatus_id = angebotStatus.id", 'status')
    		->setIntegrityCheck(false);
    }
    
   public function getAngebotByAngebotskorbId($id) {
   		$this->select
   			->where ('angebot.angebotskorb_id = '.(int)$id);
   		
   		$data = $this->fetchAll($this->select);
   		
   		$this->init();
   		
   		if(empty($data))
   			return;
   		
   		return $data->toArray();
   }
    
    


}

