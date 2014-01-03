<?php

class AccountController extends Zend_Controller_Action
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
        // action body
    }

    public function loginAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if ($auth->hasIdentity()) {
    		return $this->_forward('index');
    	}
		$form = new Application_Form_Login();
		if ($this->_request->isPost()) {
			if ($form->isValid($this->_request->getPost())) {
				if ($this->_process($form->getValues())) {
					$this->_helper->flashMessenger->addMessage('Anmeldung erfolgreich');
					$mysession = new Zend_Session_Namespace('mysession');
					if(isset($mysession->destination_url)) {
						$url = $mysession->destination_url;
						unset($mysession->destination_url);
						$this->_redirect($url);
					}
					$this->_helper->redirector->gotoSimple('index', 'startseite');
				} else {
					$this->view->errorMessage = "Anmeldung fehlgeschlagen. Email oder Passwort falsch.";
				}  
			}
		}
		$this->view->form = $form;
    }

    public function logoutAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()) {
    		$auth->clearIdentity();
    		$this->_helper->flashMessenger->addMessage('Erfolgreich abgemeldet');
    	}
		$this->_helper->redirector->gotoSimple('index', 'startseite');
    }

    public function registerAction()
    {
        $form = new Application_Form_Register();
        if ($this->_request->isPost()) {
        	if ($form->isValid($this->_request->getPost())) {
        		$userMapper = new Application_Model_BenutzerMapper();
        		if($userMapper->existEmail($form->getValue('email'))) {
        			$this->view->errorMessage = "Diese Email ist bereits registriert.";
        		} else {
        			$user = new Application_Model_Benutzer();
        			$user->setBerechtigung('Benutzer');
        			$user->setAnrede($form->getValue('title'));
        			$user->setVorname($form->getValue('name'));
        			$user->setNachname($form->getValue('lastname'));
        			$user->setPasswort(sha1($form->getValue('password')));
        			$userMapper->insertBenutzer($user, $form->getValue('email'));
        			
        			$this->_helper->flashMessenger->addMessage('Erfolgreich registriert');
        			$this->_helper->redirector->gotoSimple('index', 'startseite');
        		}
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
		$form = new Application_Form_Recover();
        if ($this->_request->isPost()) {
        	if ($form->isValid($this->_request->getPost())) {
        		//send email to recover password
        		$this->_helper->flashMessenger->addMessage('Bitte überprüfen Sie Ihre E-mails für weitere Anweisungen');
        		$this->_helper->redirector->gotoSimple('index', 'startseite');
        	}
        }
        $this->view->form = $form;
    }

    public function passwordAction()
    {
    	$form = new Application_Form_Password();
    	if ($this->_request->isPost()) {
    		if ($form->isValid($this->_request->getPost())) {
    			//save new password in db
    			$this->_helper->flashMessenger->addMessage('Passwort erfolgreich geändert');
    			$this->_helper->redirector->gotoSimple('index', 'startseite');
    		}
    	}
    	$this->view->form = $form;
    }

    public function profileAction()
    {
        // action body
    }

    protected function _process($values)
    {
    	$adapter = $this->_getAuthAdapter();
    	$adapter->setIdentity($values['email']); // form values
    	$adapter->setCredential($values['password']);
    	
    	$auth = Zend_Auth::getInstance();
    	$result = $auth->authenticate($adapter);
    	if ($result->isValid()) {
    		$user = $adapter->getResultRowObject(null, 'passwort');
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
    	//generate salt $salt = bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));
    	return $authAdapter;
    }
}