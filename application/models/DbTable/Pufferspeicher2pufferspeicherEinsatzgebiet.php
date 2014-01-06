<?php

class Application_Model_DbTable_Pufferspeicher2pufferspeicherEinsatzgebiet extends Zend_Db_Table_Abstract
{

    protected $_name = 'pufferspeicher2pufferspeicherEinsatzgebiet';
    protected $_primary = array('pufferspeicher_id', 'pufferspeicherEinsatzgebiet_id');
    
    protected $_referenceMap    = array(
    		'pufferspeicher' => array(
    				'columns'           => array('pufferspeicher_id'),
    				'refTableClass'     => 'Application_Model_DbTable_Pufferspeicher',
    				'refColumns'        => array('id')
    		),
    		'pufferspeicherEinsatzgebiet' => array(
    				'columns'           => array('pufferspeicherEinsatzgebiet_id'),
    				'refTableClass'     => 'Application_Model_DbTable_PufferspeicherEinsatzgebiet',
    				'refColumns'        => array('id')
    		)
    );


}

