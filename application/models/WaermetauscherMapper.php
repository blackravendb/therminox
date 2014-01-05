<?php

class Application_Model_WaermetauscherMapper extends Application_Model_MapperAbstract
{
	public function getDbTable() {
		if (null === $this->_dbTable) {
			$this->setDbTable ('Application_Model_DbTable_Waermetauscher');
		}
		return $this->_dbTable;
	}
	
	protected function setAttributs($row) {
		
		//Komplettes Array in Waermetauscher Objekt umwandeln und returnen
		$entry = new Application_Model_Waermetauscher($row);
		
	
		return $entry;
	}
	
	protected function createFullArray($row) {
		//Neue Array's definieren, sodass Array's in Objekte umgewandelt und in diesen eingefügt werden kann
		$row['0']['waermetauscherUnterkategorie'] = array();
		$row['0']['waermetauscherAnschluss'] = array();
		$row['0']['waermetauscherEinsatzgebiet'] = array();
		
		//Unterkategorie Array in Objekte umwandeln
		foreach($row['1'] as $key => $value){
			$row['0']['waermetauscherUnterkategorie'][] = new Application_Model_WaermetauscherUnterkategorie($value);
		}
		
		//Anschluss Array in Objekte umwandeln
		foreach($row['2'] as $key => $value){
			$row['0']['waermetauscherAnschluss'][] = new Application_Model_WaermetauscherAnschluss($value);
		}
		
		//Einsatzgebiet Array in Objekte umwandeln
		foreach($row['3'] as $key => $value){
			$row['0']['waermetauscherEinsatzgebiet'][] = new Application_Model_WaermetauscherEinsatzgebiet($value);
		}
		
		return $row[0];
	}
	
	public function getWaermetauscherByModel ($model) {
		if($model == "")
			return false;
		
		$data = $this->getDbTable()->getWaermetauscher(array('model' => $model));
		
 		if($data == "")
 			return false;
	
 		$data = $this->createFullArray($data[0]);
		return $this->setAttributs($data);
	}
	
	public function getWaermetauscherById ($id) {
		if($id == "")
			return false;
	
		$data = $this->getDbTable()->getWaermetauscher(array('id' => (int)$id));
		
		if($data == "")
			return ;
		
	$data = $this->createFullArray($data[0]);
		return $this->setAttributs($data);
	}
	

}

