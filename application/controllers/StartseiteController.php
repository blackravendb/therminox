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
           
           $produktberater = new Application_Form_ProduktberaterWt();
           $this->view->produktberater = $produktberater;
    }
	
    public function agbAction(){
    	
    }
    
//     public function __call($methodName, $args)
//     {
//     	echo "ArticleController::__call()<br />";
//     }

}