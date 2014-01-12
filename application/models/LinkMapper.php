<?php

class Application_Model_LinkMapper extends Application_Model_MapperAbstract {

	public function getDbTable() {
		if (null === $this->_dbTable) {
			$this->setDbTable ( 'Application_Model_DbTable_Link' );
		}
		return $this->_dbTable;
	}
	
	protected function setAttributs($row) {
		$entry = new Application_Model_Link($row);
	
		return $entry;
	}
	
	public function getLinkByEmail($email){
		
		$data = $this->getDbTable()->getLinkByEmail($email);
		
		if($data == "")
			return false;
		
		$ret = array();
		
		foreach ($data as $key => $value){
			$ret[$key]= $this->setAttributs($value);
		}
		return $ret;
	}
	
	public function getLinkByHexaString($string) {
		$data = $this->getDbTable()->getLinkByHexaString($string);
		
		if(empty($data))
			return;
		
		return $this->setAttributs($data[0]);
	}
	
	public function insertLink(Application_Model_Link $link) {
		return $this->getDbTable()->insertLink($link);
	}
	
	public function deleteLink(Application_Model_link $link){
		return $this->getDbTable()->deleteLink($link->getId());
	}

}

