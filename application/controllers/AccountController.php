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
    	$this->_forward('profile');
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
    		return $this->_forward('profile');
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
    		Zend_Session::destroy(true);
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
        			
        			$shipping = new Application_Model_Rechnungsadresse();
        			$shipping->setFirma($form->getValue('company'));
        			$shipping->setAnrede($form->getValue('title'));
        			$shipping->setVorname($form->getValue('name'));
        			$shipping->setNachname($form->getValue('lastname'));
        			$shipping->setStrasse($form->getValue('street'));
        			$locale = Zend_Registry::getInstance()->get("Zend_Locale");
        			$values = $locale->getTranslationList('Territory', 'de', 2);
        			$country = $values[$form->getValue('country')];
        			$shipping->setLand($country);
        			$shipping->setPlz($form->getValue('plz'));
        			$shipping->setOrt($form->getValue('town'));
        			
        			$user->insertRechnungsadresse($shipping);
        			$userMapper->insertBenutzer($user, $form->getValue('email'));
        			
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
			$this->view->errorMessage = 'Schlüssel hat kein gültiges Format.';
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
    					$user->setKlartextPasswort($form->getValue('password'));
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
    
    public function addressAction()
    {
    	$userMapper = new Application_Model_BenutzerMapper();
    	$user = $userMapper->getBenutzer(Zend_Auth::getInstance()->getIdentity()->email);
    	$this->view->shipping = $user->getLieferadresse();
    	$this->view->billing = $user->getRechnungsadresse();
    	$params = $this->_request->getParams();
    	$actionid = (isset($params['actionid']) && $params['actionid'] === 'delete') ? 'delete' : null;
    	$type = isset($params['billing']) ? 'billing' : (isset($params['shipping']) ? 'shipping' : null);
    	$number = isset($params['billing']) ? $params['billing'] : (isset($params['shipping']) ? $params['shipping'] : null);
 		if($actionid === 'delete' && isset($type) && isset($number)) {
 			if(ctype_digit($number)) {
 				$number = (int) $number;
 				$addresses = null;
 				if('billing' === $type){
 					$addresses = $user->getRechnungsadresse();
 				} else if('shipping' === $type) {
 					$addresses = $user->getLieferadresse();
 				}
 				if(is_int($number) && $number >= 0 && $number < count($addresses)) {
 					$address = $addresses[$number];
 					if('billing' === $type){
 						$user->deleteRechnungsadresse($address);
 					} else if('shipping' === $type) {
 						$user->deleteLieferadresse($address);
 					}
 					$userMapper->updateBenutzer($user);
 					$this->_helper->flashMessenger->addMessage('Adresse gelöscht.');
 					$this->_helper->redirector->gotoSimple('address', 'account');
 				}
 			} 
 		}
    }
    

    public function updateAction(){
    	$form = new Application_Form_Address();
    	
    	$userMapper = new Application_Model_BenutzerMapper();
    	$user = $userMapper->getBenutzer(Zend_Auth::getInstance()->getIdentity()->email);
    	
    	$params = $this->_request->getParams();
    	$type = isset($params['billing']) ? 'billing' : (isset($params['shipping']) ? 'shipping' : null);
    	$number = isset($params['billing']) ? $params['billing'] : (isset($params['shipping']) ? $params['shipping'] : null);
    	if(isset($type) && isset($number)){
    		if(ctype_digit($number)) {
    			$number = (int) $number;
    		} else {
    			$number = 'new';
    		}
    		
    		$addresses = null;
    		if('billing' === $type){
    			$addresses = $user->getRechnungsadresse();
    		} else if('shipping' === $type) {
    			$addresses = $user->getLieferadresse();
    		}
    		
    		if(is_int($number) && $number >= 0 && $number < count($addresses)) {
    			$address = $addresses[$number];
    			$locale = Zend_Registry::getInstance()->get("Zend_Locale");
    			$country = $locale->getTranslationList('Territory', 'de', 2);
    			$key = array_search($address->getLand(), $country);
    			$data = array(
    					'type'		=> $type,
    					'company'	=> $address->getFirma(),
    					'title' 	=> $address->getAnrede(),
    					'name'  	=> $address->getVorname(),
    					'lastname' 	=> $address->getNachname(),
    					'street' 	=> $address->getStrasse(),
    					'country' 	=> $key,
    					'plz' 		=> $address->getPlz(),
    					'town'		=> $address->getOrt()
    			);
    			$form->populate($data);
    		} else {
    			$number = 'new';
    		}
    		
    		$form->setAction("/account/update/{$type}/{$number}");
    		$this->view->type = $type;
    		
    		if ($this->_request->isPost()) {
    			if ($form->isValid($this->_request->getPost())) {
    				
    				$billing = null;
    				if(is_int($number) && $number >= 0 && $number < count($addresses)) {
    					$billing = $addresses[$number];
    				} else {
    					if($type === 'billing') {
    						$billing = new Application_Model_Rechnungsadresse();
    					} elseif($type === 'shipping') {
    						$billing = new Application_Model_Lieferadresse();
    					}
    				}
    				
    				$billing->setFirma($form->getValue('company'));
    				$billing->setAnrede($form->getValue('title'));
    				$billing->setVorname($form->getValue('name'));
    				$billing->setNachname($form->getValue('lastname'));
    				$billing->setStrasse($form->getValue('street'));
    				$locale = Zend_Registry::getInstance()->get("Zend_Locale");
    				$values = $locale->getTranslationList('Territory', 'de', 2);
    				$country = $values[$form->getValue('country')];
    				$billing->setLand($country);
    				$billing->setPlz($form->getValue('plz'));
    				$billing->setOrt($form->getValue('town'));
    				
    				if($number === 'new') {
    					if($billing instanceof Application_Model_Rechnungsadresse){
    						$user->insertRechnungsadresse($billing);
    					} elseif ($billing instanceof Application_Model_Lieferadresse) {
    						$user->insertLieferadresse($billing);
    					}
    				}
    							
    				$userMapper->updateBenutzer($user);
    				$this->_helper->flashMessenger->addMessage('Adresse gespeichert.');
    				$this->_helper->redirector->gotoSimple('address', 'account');
    			}
    		}
    	} else {
    		$this->_helper->flashMessenger->addMessage('Vorgang abgebrochen.');
    		$this->_helper->redirector->gotoSimple('address', 'account');
    	}

    	$this->view->form = $form;
    }

    public function profileAction()
    {
        $form = new Application_Form_Profile();
        $userMapper = new Application_Model_BenutzerMapper();
        $user = $userMapper->getBenutzer(Zend_Auth::getInstance()->getIdentity()->email);
     	$edit = $this->getRequest()->getParam('edit');
     	$edit = ($edit === 'true');
     	$data = array(
     			'email' => $user->getEmail(),
     			'title' => $user->getAnrede(),
     			'name'  => $user->getVorname(),
     			'lastname' => $user->getNachname()
     	);
     	if($edit) {
     		$form->populate($data);
     		$form->setAction('/account/profile/edit/true/');
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
     		
     				$this->_helper->flashMessenger->addMessage('Profil erfolgreich geändert.');
     				$this->_helper->redirector->gotoSimple('profile', 'account');
     			}
     		}
     		$this->view->form = $form;
     	} else {
     		$this->view->data = $data;
     	} 
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