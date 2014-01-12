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
    
    public function insertWaermetauscherUnterkategorie(Application_Model_WaermetauscherUnterkategorie $wtUnterkategorie, $waermetauscherId) {
    	$wtUnterkategorieData = $wtUnterkategorie->toArray();
    	
    	unset($wtUnterkategorieData['id']);
    	
    	$wtUnterkategorieData['waermetauscher_id'] = $waermetauscherId;
    	
    	$wtUnterkategorieId =$this->insert($wtUnterkategorieData);
    	
    	if(is_int($wtUnterkategorieId))
    		return true;
    	
    	return false;
    	
    }
    
    public function changeWaermetauscherUnterkategorie(Application_Model_WaermetauscherUnterkategorie $wtUnterkategorie) {
    	$wtUnterkategorieData = $wtUnterkategorie->toArray();
    	
    	foreach($wtUnterkategorieData as $key => $value){
    		if(!$wtUnterkategorie->isChanged($key))
    			unset($wtUnterkategorieData[$key]);
    	}
    	
    	$where = $this->getAdapter()->quoteInto('id = ?', $wtUnterkategorie->getId());
    	$this->update($wtUnterkategorieData, $where);
    }
    
    
}

