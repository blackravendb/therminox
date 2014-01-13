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
           $produktberater = new Application_Form_ProduktberaterWt();
           $this->view->produktberater = $produktberater;
    }
	
    public function agbAction(){
    	
    }
    
    public function datenschutzAction(){
    	
    }
    
    public function impressumAction(){
    	 
    }
 
    public function kontaktAction(){
    	$form = new Application_Form_Kontakt();
    	if ($this->_request->isPost()) {
    		if ($form->isValid($this->_request->getPost())) {
			    $mail = new Zend_Mail('utf-8');
			    $mail->setBodyHtml(htmlspecialchars($form->getValue('kontakt_text')));
			    $mail->setReplyTo($form->getValue('kontakt_email'), $form->getValue('kontakt_email'));
			    $mail->addTo('test.therminox@gmail.com', 'Therminox');
			    $mail->setSubject('Kontaktformularanfrage von ' . $form->getValue('kontakt_email'));
			    $mail->send();			    
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