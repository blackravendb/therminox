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
	
	protected function setAttributs($row){
		unset($row['id']);
		$entry = new Application_Model_Benutzer($row);
		
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
	
	public function getBenutzer($email) {
		
		$data = $this->getDbTable()->getBenutzer($email);
		
		if($data == "")
			return;
		
		return $this->setAttributs($data);
	}
	
	public function updateBenutzer(Application_Model_Benutzer $benutzer){
		
		return $this->getDbTable()->updateBenutzer($benutzer);
	}
}