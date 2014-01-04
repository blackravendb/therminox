<?php

class Application_Model_DbTable_Link extends Zend_Db_Table_Abstract
{

    protected $_name = 'link';
    protected $_primary = 'id';
    
    protected $select;
    
    public function init() {
    	$this->select = $this->select()
    	->setIntegrityCheck(false);
    }
    
    public function getLinkByEmail($email) {
    	$this->select
    	->from($this->_name)
    	->where('email =?', $email);
    	
    	$data =$this->fetchAll($this->select);
    	
    	$this->init();
    	
    	if($data == "")
    		return false;
    	
    	return $data->toArray();
    }
    
    public function getLinkByHexaString($string) {
    	$this->select
    	->from($this->_name)
    	->where('hexaString =?', $string);
    	 
    	$data =$this->fetchAll($this->select);
    	 
    	$this->init();
    	 
    	if($data == "")
    		return false;
    	 
    	return $data->toArray();
    }
    
    public function insertLink (Application_Model_Link $link) {
    	$linkData = $link->toArray();
    	
    	return $this->insert($linkData);
    }
    
    public function deleteLink($id){
    	$where = $this->getAdapter()->quoteInto('id = ?', $id);
    	
    	return $this->delete($where);
    }


}

