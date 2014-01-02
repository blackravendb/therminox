<?php

class Application_Model_DbTable_Benutzer extends Zend_Db_Table_Abstract
{

    protected $_name = 'benutzer';
    protected $_primary = 'email';
    
    protected $_dependentTables = array('Anrede');
 
    protected $_referenceMap    = array(
    		'Benutzer_Lieferadresse' => array(
    				'columns'           => 'email',
    				'refTableClass'     => 'Application_Model_DbTable_Lieferadresse',
    				'refColumns'        => 'benutzer_email',
    				'onDelete'			=> 'self::RESTRICT',
    				'onUpdate'			=> 'self::RESTRICT'
    		),
    		'Benutzer_Rechnungsadresse' => array(
    				'columns'           => 'email',
    				'refTableClass'     => 'Application_Model_DbTable_Rechnungsadresse',
    				'refColumns'        => 'benutzer_email',
    				'onDelete'			=> 'self::RESTRICT',
    				'onUpdate'			=> 'self::RESTRICT'
    		)
    );

    protected $select;
    
    public function init() {
    	$this->select = $this->select()
    		->setIntegrityCheck(false);
    }
    
    public function getBenutzer($email){
    	$this->select
       		->from('benutzer')
    		->join('anrede', 'benutzer.anrede_id = anrede.id')
    		->where('email = ?', $email);
    	 $data = $this->fetchRow($this->select);
    	 
    	 //Select Befehl wieder zurücksetzen
    	 $this->init();
    	 return $data->toArray();
    }
    
    public function fetchAll(){
    	$this->select
       ->from('benutzer')
    	->join('anrede', 'benutzer.anrede_id = anrede.id');
    	
    	$data = parent::fetchAll($this->select);
    	
    	//Select Befehl wieder zurücksetzen
    	$this->init();
    	return $data ->toArray();
    }
    
    public function updateBenutzer(Application_Model_Benutzer $benutzer) {
    	
    	$where = $this->getAdapter()->quoteInto('email = ?', $benutzer->getEmail());
    	
    	
    	//Alle Felder, die sich nicht verändert haben, löschen
    	$benutzerData = $benutzer->toArray();
    	foreach($benutzerData as $key => $value){
    		if(!$benutzer->isChanged($key)){
    			unset($benutzerData[$key]);
    		}
    	}
    	
    	//überprüfen, ob sich überhaupt Felder verändert haben
    	if(sizeof($benutzerData) == 0){
    		return false;
    	}
    	
    	//Überprüfen, ob sich Anrede verändert hat
    	if(key_exists("anrede", $benutzerData)){
    		
    		$anredeDbt = new Application_Model_DbTable_Anrede();
    	$anrede = $anredeDbt->getIdByAnrede($benutzerData['anrede']);
    	if($anrede == "")
    		return false;
    	
    	$benutzerData['anrede_id'] =$anrede['id'];
    	unset($benutzerData['anrede']);
    	}
    	
    	return $this->update($benutzerData, $where);
    }

    public function insertBenutzer(Application_Model_Benutzer $benutzer){
    	$benutzerData = $benutzer->toArray();
    	
    	
    	foreach($benutzerData as $key => $value){
    		if($value == ""){
    			return false;	
    		}    		
    	}
    	
    	$anredeDbt = new Application_Model_DbTable_Anrede();
    	$anrede = $anredeDbt->getIdByAnrede($benutzerData['anrede']);
    	if($anrede == "")
    		return false;
    	
    	$benutzerData['anrede_id'] =$anrede['id'];
    	unset($benutzerData['anrede']);
    	
    	return $this->insert($benutzerData);
    }
    
    public function deleteBenutzer ($email){
    	$where = $this->getAdapter()->quoteInto('email = ?', $email);
    	
    	return $this->delete($where);
    }
    
}

