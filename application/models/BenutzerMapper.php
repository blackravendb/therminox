<?php
class Application_Model_BenutzerMapper extends Application_Model_MapperAbstract {

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
	
	public function getBenutzer($email) {
		
		$data = $this->getDbTable()->getBenutzer($email);
		
		if($data == "")
			return false;
		
		return $this->setAttributs($data);
	}
	
	public function updateBenutzer(Application_Model_Benutzer $benutzer){
		
		return $this->getDbTable()->updateBenutzer($benutzer);
	}
	
	public function insertBenutzer(Application_Model_Benutzer $benutzer, $email) {
		
		return $this->getDbTable()->insertBenutzer($benutzer, $email);
	}
	
	public function deleteBenutzer(Application_Model_Benutzer $benutzer){
		
		return $this->getDbTable()->deleteBenutzer($benutzer->getEmail());
	}
	
	public function existEmail ($email){
		return $this->getDbTable()->existEmail($email);
	}
}