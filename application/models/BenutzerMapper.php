<?php
class Application_Model_BenutzerMapper {
//	protected $_dbTable;
	protected $_dbtBenutzer;
	protected $_dbtAnrede;
	
	public function __construct(){
		$this->_dbtBenutzer  = new Application_Model_DbTable_Benutzer();
		$this -> _dbtAnrede = new Application_Model_DbTable_Anrede();
	}
	
	
	public function fetchAll() {
		$resultSet = $this->_dbtBenutzer->fetchAll();
		$entries = array ();
		foreach ( $resultSet as $row ) {
			$entry = new Application_Model_Benutzer();
			$entry->setBerechtigung($row['berechtigung'])
				->setEmail($row['email'])
				->setNachname($row['nachname'])
				->setPasswort($row['passwort'])
				->setVorname($row['vorname'])
				->setAnrede($row['anrede']);
			$entries [] = $entry;
		}
		return $entries;
	}
	
	public function getBenutzer($email){
		
		$data = $this->_dbtBenutzer->getBenutzer($email);
		$entry = new Application_Model_Benutzer();
		
		$entry->setBerechtigung($data['berechtigung'])
			->setEmail($email)
			->setNachname($data['nachname'])
			->setPasswort($data['passwort'])
			->setVorname($data['vorname'])
			->setAnrede($data['anrede']);
		
		return $entry;
	}
}