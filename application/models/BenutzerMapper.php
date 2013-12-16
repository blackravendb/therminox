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
	
	public function find($id, Application_Model_Benutzer $benutzer)
	{
	$result = $this->getDbTable()->find($id);
	if (0 == count($result)) {
	return;
	}
	$row = $result->current();
	$benutzer->setEmail($row->email)
	->setNachname ( $row->nachname )
	->setVorname($row->vorname)
	->setAnrede_id($row->anrede_id);
	}
	
	public function fetchAll() {
		$resultSet = $this->getDbTable()->fetchAll ();
		$entries = array ();
		foreach ( $resultSet as $row ) {
			$entry = new Application_Model_Benutzer();
			$entry->setEmail ( $row->email )
			->setNachname ( $row->nachname )
			->setVorname($row->vorname)
			->setAnrede_id($row->anrede_id);
			$entries [] = $entry;
		}
		return $entries;
	}
	
	public function getBenutzer($email){
		$result = $this->getDbTable()->find($email);
		$user = $result->current();
		$anrede = $user-> findDependentRowset('Application_Model_DbTable_Anrede', 'Anreden');
		return array("email" => $email,
				"nachname" => $user->nachname,
				"vorname" => $user->vorname,
				"anrede" => $anrede->current()->anrede);
	}
}