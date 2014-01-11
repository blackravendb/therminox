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
		
		$data = $this->getDbTable()->getWaermetauscherByParams(array('model' => $model));
		
 		if($data == "")
 			return false;
	
 		$data = $this->createFullArray($data[0]);
		return $this->setAttributs($data);
	}
	
	public function getWaermetauscherById ($id) {
		if($id == "")
			return false;
	
		$data = $this->getDbTable()->getWaermetauscherByParams(array('id' => (int)$id));
		
		if($data == "")
			return ;
		
	$data = $this->createFullArray($data[0]);
		return $this->setAttributs($data);
	}
	
	public function setTemperaturMin($temp) {
		$this->getDbTable()->setTemperaturMin($temp);
	}
	
	public function setTemperaturMax($temp){
		$this->getDbTable()->setTemperaturMax($temp);
	}
	
	public function setHoeheMin($hoehe) {
		$this->getDbTable()->setHoeheMin($hoehe);
	}
	
	public function setHoeheMax($hoehe) {
		$this->getDbTable()->setHoeheMax($hoehe);
	}
	
	public function setBreiteMin($breite) {
		$this->getDbTable()->setBreiteMin($breite);	
	}		
	
	public function setBreiteMax($breite) {
		$this->getDbTable()->setBreiteMax($breite);
	}
	
	public function setEinsatzgebiet($gebiet) {
		$this->getDbTable()->setEinsatzGebiet($gebiet);
	}
	
	public function setAnschluss($anschluss) {
		$this->getDbTable()->setAnschluss($anschluss);
	}
	
	
	public function getWaermetauscher() {
		$data = $this->getDbTable()->getWaermetauscher();
		$ret = array();
		foreach($data as $value){
			$value=$this->createFullArray($value);
			$ret[] = $this->setAttributs($value);
		}
		return $ret;
	}
	
	public function getModelListe() {
		$data = $this->getDbTable()->getModelList();
		$ret = array();
		
		foreach($data as $value){
			$ret[] = $value['model'];
		}
		return $ret;
	}
	
	public function getAnschlussListe() {
		$data = $this->getDbTable()->getAnschlussListe();
		$ret = array();
		
		foreach($data as $value){
			$ret[] = $value['anschluss'];
		}
		return $ret;
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
	
	public function getStutzenmaterialListe() {
		$data = $this->getDbTable()->getStutzenmaterialListe();
		
		if(empty($data))
			$ret = array();
		
		foreach($data as $value){
			$ret[] = $value['name'];
		}
		return $ret;
	}
	
	public function deleteWaermetauscher(Application_Model_Waermetauscher $waermetauscher) {
		$id = $waermetauscher->getId();
		if(empty($id))
			return false;
		$this->getDbTable()->deleteWaermetauscher($id);
	}
	
	public function insertWaermetauscher(Application_Model_Waermetauscher $waermetauscher) {
		return $this->getDbTable()->insertWaermetauscher($waermetauscher);
	}
	
	public function updateWaermetauscher(Application_Model_Waermetauscher $waermetauscher) {
		return $this->getDbTable()->updateWaermetauscher($waermetauscher);
	}
}

