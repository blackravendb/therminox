<?php

class Application_Model_DbTable_Benutzer extends Zend_Db_Table_Abstract
{

    protected $_name = 'benutzer';
    protected $_primary = 'email';
    
     protected $_dependentTables = array('Application_Model_DbTable_Lieferadresse', 'Application_Model_DbTable_Rechnungsadresse');
 
//     protected $_referenceMap    = array(
//     		'Benutzer_Lieferadresse' => array(
//     				'columns'           => 'email',
//     				'refTableClass'     => 'Application_Model_DbTable_Lieferadresse',
//     				'refColumns'        => 'benutzer_email',
//     				'onDelete'			=> 'self::RESTRICT',
//     				'onUpdate'			=> 'self::RESTRICT'
//     		),
//     		'Benutzer_Rechnungsadresse' => array(
//     				'columns'           => 'email',
//     				'refTableClass'     => 'Application_Model_DbTable_Rechnungsadresse',
//     				'refColumns'        => 'benutzer_email',
//     				'onDelete'			=> 'self::RESTRICT',
//     				'onUpdate'			=> 'self::RESTRICT'
//     		)
//     );

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
    
    public function init() {
    	$this->select = $this->select()
    		->from($this->_name)
    		->setIntegrityCheck(false)
    		->join('anrede', $this->_name.'.anrede_id = anrede.id');
    }
    
    public function getBenutzer($email){
    	$this->select
    		->where('email = ?', $email);
    	
    	 $data = $this->fetchRow($this->select);
    	 
    	 //Select Befehl wieder zurücksetzen
    	 $this->init();
    	 
    	 //Dazugehörige Liefer und Rechnungsadreses abfragen
    	 $lieferadressen = $data->findDependentRowset('Application_Model_DbTable_Lieferadresse','benutzer');
    	 $rechnungsadressen = $data->findDependentRowset('Application_Model_DbTable_Rechnungsadresse','benutzer');

    	 //Alle Daten in Array zusammenfassen zum returnen
    	 return array($data->toArray(), $lieferadressen->toArray(), $rechnungsadressen->toArray());
    }
    
    public function fetchAll(){
    	$this->select
       ->from('benutzer')
    	->join('anrede', 'benutzer.anrede_id = anrede.id');
    	
    	$data = parent::fetchAll($this->select);
    	
    	//Select Befehl wieder zurücksetzen
    	$this->init();
    	
    	$ret = array();
    	
    	//Dazugehörige Liefer und Rechnungsadreses abfragen
    	foreach($data as $key => $value){
    		$lieferadressen = $value->findDependentRowset('Application_Model_DbTable_Lieferadresse','benutzer');
    		$rechnungsadressen = $value->findDependentRowset('Application_Model_DbTable_Rechnungsadresse','benutzer');
    		
    		$ret[] = array($value->toArray(), $lieferadressen->toArray(), $rechnungsadressen->toArray());
    	}
    	
    	return $ret;
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
    		
    		$benutzerData['anrede_id'] = $this->getAnrede_idByAnrede($benutzerData['anrede']);
    		unset($benutzerData['anrede']);
    	}
    	
    	return $this->update($benutzerData, $where);
    }

    public function insertBenutzer(Application_Model_Benutzer $benutzer, $email){
    	$benutzerData = $benutzer->toArray();
    	$benutzerData['email'] = $email;
    	
    	$benutzerData['anrede_id'] = $this->getAnrede_idByAnrede($benutzerData['anrede']);
    	unset($benutzerData['anrede']);
    	
    	return $this->insert($benutzerData);
    }
    
    public function deleteBenutzer ($email){
    	$where = $this->getAdapter()->quoteInto('email = ?', $email);
    	
    	return $this->delete($where);
    }
    
    public function existEmail($email) {
    	$this->select
    	->from(array('benutzer'),
    			array('email'))
    	->where('email = ?', $email);
    	
    	$data = $this->fetchRow($this->select);
    	$this->init();
    	
    	if($data != "") 
    		return true;
    	
    	return false;
    }
    
    private function getAnrede_idByAnrede($anrede) {
    	$anredeDbt = new Application_Model_DbTable_Anrede();
    	$anredeData = $anredeDbt->getIdByAnrede($anrede);
    	if($anrede == "")
    		return false;
    		
    	return $anredeData['id'];
    }
    
}
