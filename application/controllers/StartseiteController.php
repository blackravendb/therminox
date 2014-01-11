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
    
    public function datenschutzAction(){
    	
    }
    
    public function kontaktAction(){
    	$form = new Application_Form_Kontakt();
    	if ($this->_request->isPost()) {
    		if ($form->isValid($this->_request->getPost())) {

    			$this->_helper->flashMessenger->addMessage('Email erfolgreich verschickt.');
    			$this->_helper->redirector->gotoSimple('index', 'startseite');
    		}
    	}
    	$this->view->form = $form;
    }
    
//     public function __call($methodName, $args)
//     {
//     	echo "ArticleController::__call()<br />";
//     }

}