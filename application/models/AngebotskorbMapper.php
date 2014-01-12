<?php

class Application_Model_AngebotskorbMapper extends Application_Model_MapperAbstract {
	
	public function getDbTable() {
		if (null === $this->_dbTable) {
			$this->setDbTable ( 'Application_Model_DbTable_Angebotskorb' );
		}
		return $this->_dbTable;
	}
	
	protected function setAttributs($row){
		$row[0]['angebot'] = array();
	
		foreach($row[1] as $value) {
			$row[0]['angebot'][] = new Application_Model_Angebot($value);
		}
	
		return new Application_Model_Angebotskorb($row[0]);
	}
	
	public function getAngebotskorbByEmail($email) {
		$data = $this->getDbTable()->getAngebotskorbByEmail($email);
		if(empty($data))
			return;
		
		$ret = array();
		
		foreach($data as $value){
			$ret[] = $this->setAttributs($value);
		}
		return $ret;
	}
	
	public function insertAngebotskorb(Application_Model_Angebotskorb $angebotskorb) {
		$this->getDbTable()->insertAngebotskorb($angebotskorb);
	}
	
	public function getAngebotskoerbeStatusNotClosed() {
		$data = $this->getDbTable()->getAngebotskoerbeStatusNotClosed();
		
		if(empty($data))
			return;
		
		$ret = array();
		
		foreach($data as $value){
			$ret[] = $this->setAttributs($value);
		}
		return $ret;
	}
}

