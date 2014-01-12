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
    		->from($this->_name, array('angebotskorb_id', 'artikelnummer_id as artikelnummer', 'bemerkung'))
    		->join('angebotStatus', "$this->_name.angebotStatus_id = angebotStatus.id", 'status')
    		->setIntegrityCheck(false);
    }
    
   public function getAngebotByAngebotskorbId($id) {
   		$this->select
   			->where ('angebot.angebotskorb_id = '.(int)$id);
   		
   		$data = $this->fetchAll($this->select);
   		echo $this->select;
   		
   		$this->init();
   		
   		if(empty($data))
   			return;
   		
   		return $data->toArray();
   }
   
   public function getAngebotByAngebotskorbIdAndNotClosed($id) {
   	$where = $this->getAdapter()->quoteInto('angebotStatus.status != ?', 'Abgeschlossen');
   	$this->select
   		->where($where);
   	
   	return $this->getAngebotByAngebotskorbId($id);
   }
   
   public function insertAngebot (Application_Model_Angebot $angebot, $angebotskorbId){
   	if(empty($angebot) || empty($angebotskorbId))
   		return false;
   	
   	$angebotData = $angebot->toArray();
   	$angebotData['angebotskorb_id'] = (int)$angebotskorbId;
   	$angebotData['angebotStatus_id'] = $this->getStatus_idByStatus($angebotData['status']);
   	unset($angebotData['status']);
   	
   	$ret = $this->insert($angebotData);
   	
   }
   
   private function getStatus_idByStatus($status) {
   	$statusDbT = new Application_Model_DbTable_AngebotStatus();
   	$statusData = $statusDbT->getIdByStatus($status);
   	if(empty($statusData))
   		return;
   
   	return $statusData;
   }
    
    


}

