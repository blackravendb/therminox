<?php

class Application_Model_DbTable_Angebot extends Zend_Db_Table_Abstract
{

    protected $_name = 'angebot';
    protected $_primary = array('angebotskorb_id', 'artikelnummer_id');
    
    protected $_referenceMap    = array(
    		'angebotskorb' => array(
    				'columns'           => array('angebotskorb_id'),
    				'refTableClass'     => 'Application_Model_DbTable_Angebotskorb',
    				'refColumns'        => array('id')
    		),
    		'waermetauscher' => array(
    				'columns'           => array('waermetauscher_id'),
    				'refTableClass'     => 'Application_Model_DbTable_Waermetauscher',
    				'refColumns'        => array('id')
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

