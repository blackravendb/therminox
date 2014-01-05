<?php

abstract class Application_Model_MapperAbstract {
	
	protected $_dbTable;
	
	public abstract function getDbTable();
	
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
	
	public function fetchAll() {
		$resultSet = $this->getDbTable()->fetchAll();
		$entries = array ();
		foreach ( $resultSet as $row ) {
			$entries [] = $this->setAttributs($row);
		}
		return $entries;
	}

}

