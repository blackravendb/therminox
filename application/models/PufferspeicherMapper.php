<?php

class Application_Model_PufferspeicherMapper extends Application_Model_MapperAbstract {
	
	public function getDbTable() {
		if (null === $this->_dbTable) {
			$this->setDbTable ( 'Application_Model_DbTable_Pufferspeicher' );
		}
		return $this->_dbTable;
	}
	
	protected function setAttributs($row){
		$row[0]['einsatzgebiet'] = array();
		
		foreach($row[1] as $value) {
			$row[0]['einsatzgebiet'][] = new Application_Model_PufferspeicherEinsatzgebiet($value);
		}
		
		return new Application_Model_Pufferspeicher($row[0]);
	}
	
	public function getPufferspeicherById($id) {
		$data = $this->getDbTable()->getPufferspeicherByParams(array('id' => (int)$id));
		
		if(empty($data))
			return;
		
		return $this->setAttributs($data[0]);
	}
	
	public function getPufferspeicherByModel($model) {
		$data = $this->getDbTable()->getPufferspeicherByParams(array('model' => $model));
		
		if(empty($data))
			return;
		
		return $this->setAttributs($data[0]);
	}
	
	public function getEinsatzgebietListe() {
		$data = $this->getDbTable()->getEinsatzgebietListe();
		if(empty($data))
			return;
		
		$ret = array();
		
		foreach($data as $value){
			$ret[] = $value['einsatzgebiet'];
		}
		return $ret;
	}
	
	public function deletePufferspeicher(Application_Model_Pufferspeicher $pufferspeicher) {
		$id = $pufferspeicher->getId();
		if(empty($id))
			return false;
		$this->getDbTable()->deletePufferspeicher($id);
	}

}

