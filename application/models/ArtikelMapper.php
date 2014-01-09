<?php

class Application_Model_ArtikelMapper extends Application_Model_MapperAbstract {
	
	protected $waermetauscherMapper;
	protected $pufferspeicherMapper;
	
	public function getDbTable() {
		if (null === $this->_dbTable) {
			$this->setDbTable ( 'Application_Model_DbTable_Artikelnummer' );
		}
		return $this->_dbTable;
	}
	
	protected function getWaermetauscherMapper() {
		if(empty($this->waermetauscherMapper))
			$this->waermetauscherMapper = new Application_Model_WaermetauscherMapper();
		
		return $this->waermetauscherMapper;
	}
	
	protected function getPufferspeicherMapper() {
		if(empty($this->pufferspeicherMapper))
			$this->pufferspeicherMapper = new Application_Model_PufferspeicherMapper();
		
		return $this->pufferspeicherMapper;
	}
	
	
	public function getArtikelByArtikelnummer($id) {
		$data = $this->getDbTable()->getArtikelByArtikelnummer($id);
		
		if(empty($data))
			return;
		
		if(isset($data[0]['pufferspeicher_id']))
			return $this->getPufferspeicherMapper()->getPufferspeicherById($data[0]['pufferspeicher_id']);
		
		else if(isset($data[0]['waermetauscher_id']))
			return $this->getWaermetauscherMapper()->getWaermetauscherById($data[0]['waermetauscher_id']);
//		print_r($data);
		
		
	}
}