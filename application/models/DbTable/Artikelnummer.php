<?php

class Application_Model_DbTable_Artikelnummer extends Zend_Db_Table_Abstract
{

    protected $_name = 'artikelnummer';
	protected $_primary = 'id';
	
	protected $_referenceMap    = array(
			'pufferspeicher' => array(
					'columns'           => array('pufferspeicher_id'),
					'refTableClass'     => 'Application_Model_DbTable_Pufferspeicher',
					'refColumns'        => array('id')
			),
			'waermetauscher' => array(
					'columns'           => array('waermetauscher_id'),
					'refTableClass'     => 'Application_Model_DbTable_Waermetauscher',
					'refColumns'        => array('id')
			),
	);
	
	public function getArtikelByArtikelnummer($id) {
		$data = $this->find((int)$id);
		if(empty($data)) {
			return;
		}
		
		return $data->toArray();
	}
}

