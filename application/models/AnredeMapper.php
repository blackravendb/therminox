<?php
class Application_Model_AnredeMapper {
	
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
			$this->setDbTable ( 'Application_Model_DbTable_Anrede' );
		}
		return $this->_dbTable;
	}
	
	public function getAnredeById($id) {
		
		$data = $this->getDbTable()->find($id);
		
		if($data = "")
			return;
		
		$entry = new Application_Model_Anrede();
		
		$entry->setAnrede($data['anrede'])
			->setId($id);
		return entry;
	}
	
	public function getIdByAnrede($anrede) {
		
		$data = $this->getDbTable()->getIdByAnrede($anrede);
		
		if($data = "")
			return;
		
		$entry = new Application_Model_Anrede();
		
		$entry->setAnrede($anrede)
			->setId($data['id']);
		return entry;
	}
	
	public function fetchAll() {
		$resultSet = $this->getDbTable()->fetchAll ();
		$entries = array ();
		foreach ( $resultSet as $row ) {
			$entry = new Application_Model_Anrede();
			$entry->setId($row['id'])
				->setAnrede($row['anrede']);
			$entries [] = $entry;
		}
		return $entries;
	}
}