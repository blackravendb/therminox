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
	
	// public function save(Application_Model_Guestbook $guestbook)
	// {
	// $data = array(
	// 'email' => $guestbook->getEmail(),
	// 'comment' => $guestbook->getComment(),
	// 'created' => date('Y-m-d H:i:s'),
	// );
	
	// if (null === ($id = $guestbook->getId())) {
	// unset($data['id']);
	// $this->getDbTable()->insert($data);
	// } else {
	// $this->getDbTable()->update($data, array('id = ?' => $id));
	// }
	// }
	
	public function find($id, Application_Model_Anrede $anrede)
	{
	$result = $this->getDbTable()->find($id);
	if (0 == count($result)) {
	return;
	}
	$row = $result->current();
	$anrede->setId($row->id)
	->setAnrede($row->anrede);
	}
	
	public function getAnrede($id){
		$result = $this->getDbTable()->find($id);
	}
	
	public function fetchAll() {
		$resultSet = $this->getDbTable ()->fetchAll ();
		$entries = array ();
		foreach ( $resultSet as $row ) {
			$entry = new Application_Model_Anrede();
			$entry->setId($row->id)->setAnrede($row->anrede);
			$entries [] = $entry;
		}
		return $entries;
	}
}