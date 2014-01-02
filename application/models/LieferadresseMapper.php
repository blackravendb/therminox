<?php
class Application_Model_LieferadresseMapper {
	
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
			$this->setDbTable ( 'Application_Model_DbTable_Lieferadresse' );
		}
		return $this->_dbTable;
	}
	
	protected function setAttributs($row) {
		$entry = new Application_Model_Lieferadresse();
		$entry->setId($row['id'])
				->setBenutzer_email($row['benutzer_email'])
				->setFirma($row['firma'])
				->setNachname($row['nachname'])
				->setVorname($row['vorname'])
				->setStrasse($row['strasse'])
				->setPlz($row['plz'])
				->setLand($row['land'])
				->setAnrede($row['anrede']);
		
		return $entry;
	}
	
	
	public function fetchAll() {
		$resultSet = $this->getDbTable()->fetchAll();
		$entries = array ();
		foreach ( $resultSet as $row ) {
			$entries [] = $this->setAttributs($row);
		}
		return $entries;
	}

}