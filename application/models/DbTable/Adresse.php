<?php

class Application_Model_DbTable_adresse extends Zend_Db_Table_Abstract {

    protected $_name = 'adresse';
    protected $_primary = 'id';
    
    protected $_referenceMap    = array(
       		'anrede' => array(
    	  			'columns'           => array('id'),
    	    		'refTableClass'     => 'Application_Model_DbTable_Anrede',
    	    		'refColumns'        => array('anrede_id'),
    	    		'onDelete'			=> 'self::RESTRICT',
    	    		'onUpdate'			=> 'self::RESTRICT'
    		),
    		'benutzer' => array(
    				'columns'           => array('benutzer_email'),
    				'refTableClass'     => 'Application_Model_DbTable_Benutzer',
    				'refColumns'        => array('email'),
    				'onDelete'			=> 'self::RESTRICT',
    				'onUpdate'			=> 'self::RESTRICT'
    		)
    );
    
    public function changeAdresse ($adressen, $email) {
    	if(empty($adressen) || empty($email))
    		return;
    	
    	foreach ($adressen as $adresse) {
    		//neue Adresse wurde angelegt(noch keine ID = Auto Increment angelegt)
    		if($adresse->getId === NULL)
    			$this->insertAdresse($adresse, $email);
    		//überprüfen, ob sich überhaupt ein Feld geändert hat
    		else {
    			foreach($adresse->toArray() as $key => $value){
    				if($adresse->isChanged($key)){
    					//Mindestens ein Feld wurde aktualisiert
    					$this->updateAdresse($adresse, $email);
    				}
    			}
    		}
    			$this->changeAdresse($value);
    	}
    }
    
    protected function insertAdresse($adresse, $email) {
    	$adressData = $adresse->toArray();
    	
    	$adressData['benutzer_email'] = $email;
    	$adressData['lieferadresse'] = $adresse instanceof Application_Model_Lieferadresse ? true : false;
    	
    	$adressData['anrede_id'] = $this->getAnrede_idByAnrede($adressData['anrede']);
    	unset($adressData['anrede']);
    	
    	return $this->insert($adressData);
    }
    
    protected function updateAdresse($adresse, $email) {
    	$where = $this->getAdapter()->quoteInto('id = ?', $adresse->getId());
    	//Überprüfen, welche Adressen sich geändert haben
    	$adressData = $adresse->toArray();
    	
    	foreach($adressData as $key => $value) {
    		if($adresse->isChanged($key) !== 1) {
    			unset($adressData[$key]);
    		}
    	}
    	//Überprüfen, ob Felder übrig geblieben sind
    	
    	if(!empty($adressData)) {
    		$adressData['benutzer_email'] = $email;
    		$adressData['lieferadresse'] = $adresse instanceof Application_Model_Lieferadresse ? true : false;
			
    		$adressData['anrede_id'] = $this->getAnrede_idByAnrede($adressData['anrede']);
    		unset($adressData['anrede']);
    		
    		$this->update($adressData, $where);
    	}
    }
    
    private function getAnrede_idByAnrede($anrede) {
    	$anredeDbt = new Application_Model_DbTable_Anrede();
    	$anredeData = $anredeDbt->getIdByAnrede($anrede);
    	if($anrede == "")
    		return false;
    
    	return $anredeData['id'];
    }

}
