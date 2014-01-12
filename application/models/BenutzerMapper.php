<?php
class Application_Model_BenutzerMapper extends Application_Model_MapperAbstract {

	public function getDbTable() {
		if (null === $this->_dbTable) {
			$this->setDbTable ( 'Application_Model_DbTable_Benutzer' );
		}
		return $this->_dbTable;
	}
	
	protected function setAttributs($row){
	//	unset($row[0]['id']);
		
		//Lieferadresse Arrray zu Objekten wandeln
		if(!empty($row[1])){
			$row[0]['lieferadresse'] = array();
			$row[0]['rechnungsadresse'] = array();
			//Liefer bzw. Rechnungsadressen-objekte erstellen
			foreach($row[1] as $key => $value) {
				if($value['lieferadresse']){
					$row[0]['lieferadresse'][] = new Application_Model_Lieferadresse($value);
				}
				else {
					$row[0]['rechnungsadresse'][] = new Application_Model_Rechnungsadresse($value);
				}
				
			}
		}
		
		return new Application_Model_Benutzer($row[0]);
	}
	
	public function getBenutzer($email) {
		
		$data = $this->getDbTable()->getBenutzer($email);
		
		if($data === false)
			return false;
		
		if(empty($data))
			return;
		
		return $this->setAttributs($data);
	}
	
	public function updateBenutzer(Application_Model_Benutzer $benutzer) {
		
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