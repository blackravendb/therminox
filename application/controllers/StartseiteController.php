<?php

class StartseiteController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	if ($this->_helper->flashMessenger->hasMessages()) {
    		$this->view->messages = $this->_helper->flashMessenger->getMessages();
    	}
    }

    public function indexAction()
    {
           $test = new Application_Model_BegriffMapper();
           $this->view->entries = $test->fetchAll();
    }
	
    public function agbAction(){
    	
    }

}