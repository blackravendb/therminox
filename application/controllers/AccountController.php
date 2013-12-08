<?php

class AccountController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
		$form = new Application_Form_Login();
		if ($this->_request->isPost()) {
			if ($form->isValid($this->_request->getPost())) {
				if ($this->_process($form->getValues())) {
					$this->_helper->redirector->gotoSimple('index', 'startseite');
				}
			}
		}
		$this->view->form = $form;
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
		$this->_helper->redirector->gotoSimple('index', 'startseite');
    }

    public function registerAction()
    {
        $form = new Application_Form_Register();
        if ($this->_request->isPost()) {
        	if ($form->isValid($this->_request->getPost())) {
        		$this->_helper->redirector->gotoSimple('index', 'startseite');
        	}
        }
        $this->view->form = $form;
    }

    public function confirmAction()
    {
        // action body
    }

    public function recoverAction()
    {
        // action body
    }

    public function passwordAction()
    {
        // action body
    }

    public function profileAction()
    {
        // action body
    }

    protected function _process($values)
    {
    	$adapter = $this->_getAuthAdapter();
    	$adapter->setIdentity($values['email']); 
    	$adapter->setCredential($values['password']);
    	
    	$auth = Zend_Auth::getInstance();
    	$result = $auth->authenticate($adapter);
    	if ($result->isValid()) {
    		$user = $adapter->getResultRowObject();
    		$auth->getStorage()->write($user);
    		return true;
    	}
    	return false;
    }
    
    protected function _getAuthAdapter() {
    
    	$dbAdapter = Zend_Db_Table::getDefaultAdapter();
    	$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
    
    	$authAdapter->setTableName('benutzer') //Datenbanktabellenname
    	->setIdentityColumn('email') //Spaltenname der email
    	->setCredentialColumn('passwort') //Spaltenname des passwords
    	->setCredentialTreatment('SHA1(?)'); //evtl. 'SHA1(CONCAT(?,salt)) &  AND bestaetigt = 1'
    
    	return $authAdapter;
    }
}















