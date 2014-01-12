<?php

class Application_Model_DbTable_Benutzer extends Zend_Db_Table_Abstract
{

    protected $_name = 'benutzer';
    protected $_primary = 'email';
    
    protected $_dependentTables = array('Application_Model_DbTable_Adresse',
   										 'Application_Model_DbTable_Link',
    									'Application_Model_DbTable_Angebotskorb');
 
    protected $_referenceMap    = array(
       		'anrede' => array(
    	  			'columns'           => array('anrede_id'),
    	    		'refTableClass'     => 'Application_Model_DbTable_Anrede',
    	    		'refColumns'        => array('id'),
    	    		'onDelete'			=> 'self::RESTRICT',
    	    		'onUpdate'			=> 'self::RESTRICT'
    	    ),
    	);

    protected $select;
    
    protected $adresseDbTable;
    
    public function init() {
    	$this->select = $this->select()
    		->from($this->_name)
    		->setIntegrityCheck(false)
    		->join('anrede', $this->_name.'.anrede_id = anrede.id');
    }
    
    protected function getAdresseDbTable(){
    	if(empty($this->AdresseDbTable)){
    		$this->AdresseDbTable = new Application_Model_DbTable_Adresse();
    	}
    	return $this->AdresseDbTable;
    }
    
    public function getBenutzer($email){
    	try {
	    	$this->select
	    		->where('email = ?', $email);
	    	
	    	 $data = $this->fetchRow($this->select);
	    	 
	    	 //Select Befehl wieder zurücksetzen
	    	 $this->init();
	    	 
	    	 //Dazugehörige Adressen abfragen
	    	 $adressen = $data->findDependentRowset('Application_Model_DbTable_Adresse','benutzer');
			 
	    	 if(!empty($adressen)) {
	    	 	$adressenData = $adressen->toArray();
	    	 	foreach($adressenData as $key => $adresse) {
	    	 		$adressenData[$key]['anrede'] = $this->getAnredeByAnrede_id($adresse['anrede_id']);
	    	 	}
	    	 }
	    	 //Alle Daten in Array zusammenfassen zum returnen
	    	 return array($data->toArray(), $adressenData);
    	}
    	catch(Exception $e) {
    		return false;
    	}
    }
    
    public function fetchAll(){
    	try {
	    	$this->select
	       ->from('benutzer')
	    	->join('anrede', 'benutzer.anrede_id = anrede.id');
	    	
	    	$data = parent::fetchAll($this->select);
	    	
	    	//Select Befehl wieder zurücksetzen
	    	$this->init();
	    	
	    	$ret = array();
	    	
	    	//Dazugehörige Adressen abfragen
	    	foreach($data as $key => $value){
	    		$adressen = $value->findDependentRowset('Application_Model_DbTable_Adresse','benutzer');
	    		
	    		$ret[] = array($value->toArray(), $adressen->toArray());
	    	}
	    	
	    	return $ret;
    	}
    	catch(Exception $e) {
    		return false;
    	}
    }
    
    public function updateBenutzer(Application_Model_Benutzer $benutzer) {
    	try {
    		$this->getAdapter()->beginTransaction();
	    	$where = $this->getAdapter()->quoteInto('email = ?', $benutzer->getEmail());
	    	
	    	
	    	//Alle Felder, die sich nicht verändert haben, löschen
	    	$benutzerData = $benutzer->toArray();
	    	foreach($benutzerData as $key => $value){
	    		if(!$benutzer->isChanged($key)){
	    			unset($benutzerData[$key]);
	    		}
	    	}
	    	
	    	//Fremde Tabellen überrüfen:
	    	//Überprüfen, ob sich Anrede verändert hat
	    	if(key_exists("anrede", $benutzerData)) {
	    		
	    		$benutzerData['anrede_id'] = $this->getAnrede_idByAnrede($benutzerData['anrede']);
	    		unset($benutzerData['anrede']);
	    	}
	    	
	    	//Überprüfen, ob sich Rechnungsadressen verändert hat
	    	if(key_exists('rechnungsadresse', $benutzerData)){
	    		foreach($benutzerData['rechnungsadresse'] as $value){
	    			$this->getAdresseDbTable()->changeAdresse($value, $benutzer->getEmail());
	    		}
	    		unset($benutzerData['rechnungsadresse']);
	    	}
	    	
	    	//Überprüfen, ob sich Lieferadresse verändert hat
	    	if(key_exists('lieferadresse', $benutzerData)){
	    		foreach($benutzerData['lieferadresse'] as $value) {
	    			$this->getAdresseDbTable()->changeAdresse($value, $benutzer->getEmail());
	    		}
	    		unset($benutzerData['lieferadresse']);
	    	}
	    	
	    	//Überprüfen ob Liefer- Rechnungsadressen gelöscht werden müssen
	    	$adressen2delete = $benutzer->getAdressen2delete();
	    	if(!empty($adressen2delete))
	    		$this->getAdresseDbTable()->deleteAdresse($adressen2delete);
	    	
	    	//überprüfen, ob sich sonst noch Felder verändert haben
	    	if(sizeof($benutzerData) == 0){
	    		$this->getAdapter()->commit();
	    		return true;
	    	}
	    	
	    	return $this->update($benutzerData, $where);
	    	$this->getAdapter()->commit();
	    	return true;
    	}
    	catch(Exception $e) {
    		$this->getAdapter()->rollBack();
    		return false;
    	}
    }

    public function insertBenutzer(Application_Model_Benutzer $benutzer, $email) {
    	try {
    		$this->getAdapter()->beginTransaction();
	    	$benutzerData = $benutzer->toArray();
	    	$benutzerData['email'] = $email;
	    	
	    	
	    	//Anrede ID ermitteln
	    	$benutzerData['anrede_id'] = $this->getAnrede_idByAnrede($benutzerData['anrede']);
	    	unset($benutzerData['anrede']);
	
	    	//Liefer und Rechnungsadressen für späteres schreiben zwischenspeichern
	    	$lieferadressen = $benutzer->getLieferadresse();
	    	$rechnungsadresse = $benutzer->getRechnungsadresse();
	    	
	    	unset($benutzerData['lieferadresse']);
	    	unset($benutzerData['rechnungsadresse']);
	    	
	    	$this->insert($benutzerData);
	
	    	//Liefer und Rechnungsadressen schreiben
	    	if(!empty($lieferadressen)){
	    		foreach($lieferadressen as $value){
	    			$this->getAdresseDbTable()->changeAdresse($value, $email);
	    		}
	    	}
	    	if(!empty($rechnungsadresse)){
	    		foreach($rechnungsadresse as $value){
	    			$this->getAdresseDbTable()->changeAdresse($value, $email);
	    		}
	    	}
	    	$this->getAdapter()->commit();
	    	return true;
    	}
    	catch(Exception $e) {
    		$this->getAdapter()->rollBack();
    		return false;
    	}
    }
    
    public function deleteBenutzer ($email){
    	try {
    	$where = $this->getAdapter()->quoteInto('email = ?', $email);
    	
    	$this->delete($where);
    	return true;
    	}
    	catch(Exception $e) {
    		return false;
    	}
    }
    
    public function existEmail($email) {
    	$select = $this->select();
    	$select
    		->from(array('benutzer'),
    			array('email'))
    	->where('email = ?', $email);
    	
    	$data = $this->fetchRow($select);
    	$this->init();
    	
    	if(!empty($data)) 
    		return true;
    	
    	return false;
    }
    
    private function getAnrede_idByAnrede($anrede) {
    	$anredeDbt = new Application_Model_DbTable_Anrede();
    	$anredeData = $anredeDbt->getIdByAnrede($anrede);
    	if(empty($anredeData))
    		return false;
    		
    	return $anredeData['id'];
    }
    
    private function getAnredeByAnrede_id($id) {
    $anredeDbT = new Application_Model_DbTable_Anrede();
    $anredeData = $anredeDbT->getAnredeByAnrede_id($id);
    if(empty($anredeData))
    	return false;
    return $anredeData['anrede'];
    }
    
    
}
