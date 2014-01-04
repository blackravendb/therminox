<?php

class Application_Model_WaermetauscherGeloetetMapper extends Application_Model_MapperAbstract
{
	public function getDbTable() {
		if (null === $this->_dbTable) {
			$this->setDbTable ('Application_Model_DbTable_WaermetauscherGeloetet');
		}
		return $this->_dbTable;
	}
	
	protected function setAttributs($row) {
		$row['0']['waermetauscherGeloetetUnterkategorie'] = array();
		foreach($row['1'] as $key => $value){
			$row['0']['waermetauscherGeloetetUnterkategorie'][] = new Application_Model_WaermetauscherGeloetetUnterkategorie($value);
		}
		$entry = new Application_Model_WaermetauscherGeloetet($row['0']);
		
	
		return $entry;
	}
	
	public function getWaermetauscherGeloetetByModel ($model) {
		if($model == "")
			return false;
		
		$data = $this->getDbTable()->getWaermetauscherGeloetet(array('model' => $model));
		
 		if($data == "")
 			return false;
	
 		return $this->setAttributs($data['0']);
	}
	
	public function getWaermetauscherGeloetetById ($id) {
		if($id == "")
			return false;
	
		$data = $this->getDbTable()->getWaermetauscherGeloetet(array('id' => (int)$id));
	
		if($data == "")
			return ;
	
		return $this->setAttributs($data['0']);
	}
	

}

