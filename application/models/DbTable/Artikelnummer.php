<?php

class Application_Model_DbTable_Artikelnummer extends Zend_Db_Table_Abstract
{

    protected $_name = 'artikelnummer';
	protected $_primary = 'id';
	
	protected $_dependentTables = array('Application_Model_DbTable_Angebot');
	
	protected $_referenceMap    = array(
			'pufferspeicher' => array(
					'columns'           => array('pufferspeicher_id'),
					'refTableClass'     => 'Application_Model_DbTable_Pufferspeicher',
					'refColumns'        => array('id'),
					'onDelete'			=> 'self::CASCADE',
					'onUpdate'			=> 'self::CASCADE'
			),
			'waermetauscher' => array(
					'columns'           => array('waermetauscher_id'),
					'refTableClass'     => 'Application_Model_DbTable_Waermetauscher',
					'refColumns'        => array('id'),
					'onDelete'			=> 'self::CASCADE',
					'onUpdate'			=> 'self::CASCADE'
			)
	);
	
	public function getArtikelByArtikelnummer($id) {
		$data = $this->find((int)$id);
		if(empty($data)) {
			return;
		}
		
		return $data->toArray();
	}
}

