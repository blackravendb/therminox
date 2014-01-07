<?php

class Application_Model_DbTable_Link extends Zend_Db_Table_Abstract
{

    protected $_name = 'link';
    protected $_primary = 'id';
    
    protected $select;
    
    public function init() {
    	$this->select = $this->select()
    	->from($this->_name, array('id', 'benutzer_email as email', 'hexaString', 'typ'))
    	->setIntegrityCheck(false);
    }
    
    public function getLinkByEmail($email) {
    	$this->select
    	
    	->where('email =?', $email);
    	$data =$this->fetchAll($this->select);
    	
    	$this->init();
    	
    	if($data == "")
    		return;
    	
    	return $data->toArray();
    }
    
    public function getLinkByHexaString($string) {
    	$this->select
    	->where('hexaString =?', $string);
    	 
    	$data =$this->fetchAll($this->select);
    	$this->init();
    	 
    	if($data == "")
    		return;
    	 
    	return $data->toArray();
    }
    
    public function insertLink (Application_Model_Link $link) {
    	$linkData = $link->toArray();
    	
    	$linkData['benutzer_email'] = $linkData['email'];
    	unset($linkData['email']);
    	return $this->insert($linkData);
    }
    
    public function deleteLink($id){
    	$where = $this->getAdapter()->quoteInto('id = ?', $id);
    	
    	return $this->delete($where);
    }


}

