<?php
class Application_Model_BenutzerMapper {
	
protected $_dbTable;

	public function setDbTable($dbTable) {
		if (is_string ( $dbTable )) {
			$dbTable = new $dbTable ();
		}
		if (! $dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception ( 'Ungültiges Table Data Gateway angegeben' );
		}
		$this->_dbTable = $dbTable;
		return $this;
	}
	public function getDbTable() {
		if (null === $this->_dbTable) {
			$this->setDbTable ( 'Application_Model_DbTable_Benutzer' );
		}
		return $this->_dbTable;
	}
	
	
	public function fetchAll() {
		$resultSet = $this->getDbTable()->fetchAll();
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
	
	public function getBenutzer($email) {
		
		$data = $this->getDbTable()->getBenutzer($email);
		
		if($data = "")
			return;
		
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