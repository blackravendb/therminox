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
    
    public function deleteAction(){
    	$form = new Application_Form_Delete();
    	if ($this->_request->isPost()) {
    		if ($form->isValid($this->_request->getPost())) {
    			$userMapper = new Application_Model_BenutzerMapper();
    			$user = $userMapper->getBenutzer(Zend_Auth::getInstance()->getIdentity()->email);
    			Zend_Auth::getInstance()->clearIdentity();
    			$userMapper->deleteBenutzer($user);
    			$this->_helper->flashMessenger->addMessage('Account erfolgreich gelöscht');
    			$this->_helper->redirector->gotoSimple('index', 'startseite');
    		}
    	}
    	$this->view->form = $form;
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
        			$user->setKlartextPasswort($form->getValue('password'));
        			$user->setBestaetigt(0);
        			$userMapper->insertBenutzer($user, $form->getValue('email'));
        			
        			$shipping = new Application_Model_Lieferadresse();
        			$shipping->setBenutzer_email($form->getValue('email'));
        			$shipping->setFirma($form->getValue('company'));
        			$shipping->setAnrede($form->getValue('title'));
        			$shipping->setVorname($form->getValue('name'));
        			$shipping->setNachname($form->getValue('lastname'));
        			$shipping->setStrasse($form->getValue('street'));
        			$locale = Zend_Registry::getInstance()->get("Zend_Locale");
        			$country = $locale->getTranslationList('Territory', 'de', 2)[$form->getValue('country')];
        			$shipping->setLand($country);
        			$shipping->setPlz($form->getValue('plz'));
        			$shipping->setOrt($form->getValue('town'));
        			$shippingMapper = new Application_Model_LieferadresseMapper();
        			//$shippingMapper->insertLieferadresse($shipping);
        			
        			
        			$key = App_Util::generateHexString();
        			
        			$link = new Application_Model_Link();
        			$link->setEmail($form->getValue('email'));
        			$link->setHexaString($key);
        			$link->setTyp(0); // 0: account confirmation 
        			$linkMapper = new Application_Model_LinkMapper();
        			$linkMapper->insertLink($link);
        			
        			
        			$mail = new App_Mail();
        			$mail->assignValues(array(
        				'name' => $form->getValue('name'),
        				'key'  => $key
        			));
        			$mail->addTo($form->getValue('email'));
        			$mail->setSubject('Ihre Registrierung bei Therminox');
        			$mail->setFrom('test.therminox@gmail.com', 'Therminox');
        			$mail->send('register');
        			
        			$this->_helper->flashMessenger->addMessage('Erfolgreich registriert');
        			$this->_helper->redirector->gotoSimple('index', 'startseite');
        		}
        	}
        }
        $this->view->form = $form;
    }

    public function confirmAction()
    {
        $key = $this->_request->getParam('key');
        $validator = new Zend_Validate_Hex();
	    if ($validator->isValid($key) && strlen($key) === 40) {
	    	$linkMapper = new Application_Model_LinkMapper();
	    	$link = $linkMapper->getLinkByHexaString($key);
	    	if($link && $link->getTyp() === 0){ //check if account confirm type
	    		$userMapper = new Application_Model_BenutzerMapper();
	    		$user = $userMapper->getBenutzer($link->getEmail());
	    		$user->setBestaetigt(1);
	    		$userMapper->updateBenutzer($user);
	    		
	    		$linkMapper->deleteLink($link);
	    		
	    		$this->_helper->flashMessenger->addMessage('Email erfolgreich bestätigt.');
	    		$this->_helper->redirector->gotoSimple('index', 'startseite');
	    	} else {
	    		$this->view->errorMessage = 'Schlüssel nicht gefunden.';
	    	}
		} else {
			$this->view->errorMessage = 'Schlüssel hat kein gültiges Format';
		}
    }
    
    /**
     * Initiate Password Recovery Process
     */
    public function lostAction()
    {
    	$form = new Application_Form_Lost();
    	if ($this->_request->isPost()) {
    		if ($form->isValid($this->_request->getPost())) {
    			//send email to recover password
    			$userMapper = new Application_Model_BenutzerMapper();
    			$user = $userMapper->getBenutzer($form->getValue('email'));
    			if($user){
    				$key = App_Util::generateHexString();
    				
    				$link = new Application_Model_Link();
    				$link->setEmail($form->getValue('email'));
    				$link->setHexaString($key);
    				$link->setTyp(1); // 1: password recovery
    				$linkMapper = new Application_Model_LinkMapper();
    				$linkMapper->insertLink($link);
    				
    				$mail = new App_Mail();
    				$mail->assignValues(array(
    						'name' => $user->getVorname(),
    						'key'  => $key
    				));
    				$mail->addTo($form->getValue('email'));
    				$mail->setSubject('Therminox - Passwort verloren');
    				$mail->setFrom('test.therminox@gmail.com', 'Therminox');
    				$mail->send('lost');
    				$this->_helper->flashMessenger->addMessage('Bitte überprüfen Sie Ihre E-mails für weitere Anweisungen');
    				$this->_helper->redirector->gotoSimple('index', 'startseite');
    			} else {
    				$this->view->errorMessage = 'Diese E-mail ist nicht registriert.';
    			}
    		}
    	}
    	$this->view->form = $form;
    }
    
	/**
	 * Complete Password Recovery Process, user can create a new password.
	 */
    public function recoverAction()
    {
    	$key = $this->_request->getParam('key');
    	$validator = new Zend_Validate_Hex();
    	if ($validator->isValid($key) && strlen($key) === 40) {
    		$linkMapper = new Application_Model_LinkMapper();
    		$link = $linkMapper->getLinkByHexaString($key);
    		if($link && $link->getTyp() === 1){ //check if password recovery type
    			$form = new Application_Form_Recover($key);
    			if ($this->_request->isPost()) {
    				if ($form->isValid($this->_request->getPost())) {
    					$userMapper = new Application_Model_BenutzerMapper();
    					$user = $userMapper->getBenutzer($link->getEmail());
    					$user->setPasswort($form->getValue('password'));
    					$userMapper->updateBenutzer($user);
    			
    					$linkMapper->deleteLink($link);
    					
    					$this->_helper->flashMessenger->addMessage('Passwort erfolgreich geändert');
    					$this->_helper->redirector->gotoSimple('index', 'startseite');
    				}
    			}
    			$this->view->form = $form;
    		} else {
    			$this->view->errorMessage = 'Schlüssel nicht gefunden.';
    		}
    	} else {
    		$this->view->errorMessage = 'Schlüssel hat kein gültiges Format';
    	}
    }

    public function passwordAction()
    {
    	$form = new Application_Form_Password();
    	if ($this->_request->isPost()) {
    		if ($form->isValid($this->_request->getPost())) {
    			$userMapper = new Application_Model_BenutzerMapper();
    			$user = $userMapper->getBenutzer(Zend_Auth::getInstance()->getIdentity()->email);
    			$old_password = sha1($form->getValue('old_password') . $user->getSalt());
    			if($user->getPasswort() === $old_password) {
    				$user->setKlartextPasswort($form->getValue('new_password'));
    				$userMapper->updateBenutzer($user);
    				$this->_helper->flashMessenger->addMessage('Passwort erfolgreich geändert');
    				$this->_helper->redirector->gotoSimple('index', 'startseite');
    			} else {
    				$this->view->errorMessage = 'Altes Passwort ist falsch.';
    			}
    		}
    	}
    	$this->view->form = $form;
    }
    
    public function shippingAction()
    {
    	
    }
    
    public function billingAction()
    {
    	
    }
    

    public function profileAction()
    {
        $form = new Application_Form_Profile();
        $userMapper = new Application_Model_BenutzerMapper();
        $user = $userMapper->getBenutzer(Zend_Auth::getInstance()->getIdentity()->email);
        $data = array( 
        	'email' => $user->getEmail(),
        	'title' => $user->getAnrede(),
        	'name'  => $user->getVorname(),
        	'lastname' => $user->getNachname()
        );
        $form->populate($data);
        if ($this->_request->isPost()) {
        	if ($form->isValid($this->_request->getPost())) {
				$user->setAnrede($form->getValue('title'));
				$user->setVorname($form->getValue('name'));
				$user->setNachname($form->getValue('lastname'));
				$userMapper->updateBenutzer($user);
				
				//update Zend Auth Identity
				$auth = Zend_Auth::getInstance()->getIdentity();
				$auth->title = $form->getValue('title');
				$auth->vorname = $form->getValue('name');
				$auth->nachname = $form->getValue('nachname');
				
				$this->view->success = 'Profil erfolgreich geändert.';
        	}
        }
        $this->view->form = $form;
    }

    protected function _process($values)
    {
    	$dbAdapter = Zend_Db_Table::getDefaultAdapter();
    	$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
    	
    	$authAdapter->setTableName('benutzer') 
    	->setIdentityColumn('email') 
    	->setCredentialColumn('passwort') 
    	->setCredentialTreatment('SHA1(CONCAT(?,salt)) AND bestaetigt = 1');

    	$authAdapter->setIdentity($values['email']); // form values
    	$authAdapter->setCredential($values['password']);
    	
    	$auth = Zend_Auth::getInstance();
    	$result = $auth->authenticate($authAdapter);
    	if ($result->isValid()) {
    		$user = $authAdapter->getResultRowObject(null, 'passwort');
    		$auth->getStorage()->write($user);
    		return true;
    	}
    	return false;
    }
}