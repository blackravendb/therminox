<?php
class AngebotController extends Zend_Controller_Action {
	public function init() {
	}
	public function indexAction() {
		$db_mapper = new Application_Model_AngebotskorbMapper ();
		$email = Zend_Auth::getInstance ()->getIdentity ()->email;
		$offers = $db_mapper->getAngebotskorbByEmail ( $email );
		$this->view->offers = $offers;
	}
	public function erstellenAction() {
		$request = $this->getRequest ();
		$art_nr = $request->getParam ( 'artikelnummer' );
		$cat = null;
		$art = null;
		
		$artmapper = new Application_Model_ArtikelMapper ();
		$art = $artmapper->getArtikelByArtikelnummer ( $art_nr );
		$art = $art->getModel ();
		
		$this->view->artID = $art;
		if (substr_compare ( $art, 'BH', 0, 2, false ) === 0) {
			$cat = "Wärmetauscher";
			$this->view->artCat = $cat;
		}
		if (substr_compare ( $art, 'VV', 0, 2, false ) === 0) {
			$cat = "Pufferspeicher";
			$this->view->artCat = $cat;
		}
		if (substr_compare ( $art, 'LA', 0, 2, false ) === 0) {
			$cat = "Pufferspeicher";
			$this->view->artCat = $cat;
		}
		
		$form = new Application_Form_AngebotErstellen ();
		
		$form->setMethod ( 'post' );
		$action = '/Angebot/erstellen/artikelnummer/' . $art_nr;
		$form->setAction ( $action );
		$this->view->form = $form;
		
		if ($this->_request->isPost ()) {
			$formData = $this->getRequest ()->getPost ();
			
			if ($form->isValid ( $formData )) {
				$form->populate ( $_POST );
				
				$form_message = htmlspecialchars ( $form->getValue ( 'extraInfo' ) );
				
				if ($form->addMore->isChecked ()) {
					if (! isset ( $_SESSION ['angebotskorb'] )) {
						$_SESSION ['angebotskorb'] = new Application_Model_Angebotskorb ();
						$email = Zend_Auth::getInstance ()->getIdentity ()->email;
						$_SESSION ['angebotskorb']->setBenutzer_email ( $email );
					}
					
					$offer = new Application_Model_Angebot ();
					$offer->setArtikelnummer ( $art_nr );
					$offer->setBemerkung ( $form_message );
					$offer->setStatus ( 'Offen' );
					$_SESSION ['angebotskorb']->insertAngebot ( $offer );
					$this->_redirect ( $this->_request->getPost ( 'return' ) );
				}
				if ($form->submit->isChecked ()) {
					if (isset ( $_SESSION ['angebotskorb'] )) {
						$angebotskorb = $_SESSION ['angebotskorb'];
					}
					if (! isset ( $_SESSION ['angebotskorb'] )) {
						$angebotskorb = new Application_Model_Angebotskorb ();
						$email = Zend_Auth::getInstance ()->getIdentity ()->email;
						$angebotskorb->setBenutzer_email ( $email );
					}
					$offer = new Application_Model_Angebot ();
					$offer->setArtikelnummer ( $art_nr );
					$offer->setBemerkung ( $form_message );
					$offer->setStatus ( 'Offen' );
					if (! is_null ( $offer )) {
						$angebotskorb->insertAngebot ( $offer );
					}
					$mapper = new Application_Model_AngebotskorbMapper ();
					$mapper->insertAngebotskorb ( $angebotskorb );
					unset ( $_SESSION ['angebotskorb'] );
					
					$this->_redirect ( 'angebot/' );
				}
			}
		}
	}
	public function anzeigenAction() {
		$request = $this->getRequest ();
		$offerID = $request->getParam ( 'id' );
		$this->view->offerID = $offerID;
		
		$db_mapper = new Application_Model_AngebotskorbMapper ();
		$email = Zend_Auth::getInstance ()->getIdentity ()->email;
		$offers = $db_mapper->getAngebotskorbByEmail ( $email );
		$articles = array ();
		
		foreach ( $offers as $offer ) {
			if ($offerID == $offer->getId ()) {
				$articles = $offer->getAngebot ();
			}
		}
		
		$this->view->articles = $articles;
	}
	public function addAction() {
		$request = $this->getRequest ();
		$artnr = $request->getParam ( 'artID' );
		if (null != $artnr) {
			$cart = null;
			if (isset ( $_SESSION ['angebotskorb'] ) && $_SESSION ['angebotskorb'] instanceof ShoppingCartIf) {
				$cart = $_SESSION ['angebotskorb'];
			} else {
				$cart = new ShoppingCart ();
			}
			$cart->addItem ( $artnr );
			$_SESSION ['angebotskorb'] = $cart;
			
			$this->_redirect ( '/artikel' );
		} else {
			$this->view->message = 'Artikel konnte nicht hinzugefügt werden';
			if (isset ( $_SERVER ['HTTP_REFERER'] )) {
				$this->view->link = $_SERVER ['HTTP_REFERER'];
			} else {
				$this->view->link = '/artikel';
			}
		}
	}
	public function abschickenAction() {
		// action body
		// in db schreiben + email schicken
		$angebotskorb = $_SESSION ['angebotskorb'];
		
		$mapper = new Application_Model_AngebotskorbMapper ();
		$mapper->insertAngebotskorb ( $angebotskorb );
		unset ( $_SESSION ['angebotskorb'] );
		
		$this->_redirect ( 'angebot/' );
	}
	public function removeAction() {
		$request = $this->getRequest ();
		$pos = $request->getParam ( 'position' );
		if (null !== $pos) {
			$angebotskorb = $_SESSION ['angebotskorb'];
			$angebot = $angebotskorb->getAngebot ();
			$angebot = $angebot [$pos];
			$angebotskorb->deleteAngebot ( $angebot );
			if (is_null ( $angebotskorb->getAngebot () )) {
				unset ( $_SESSION ['angebotskorb'] );
			}
			if (! is_null ( $angebotskorb->getAngebot () )) {
				$_SESSION ['angebotskorb'] = $angebotskorb;
			}
		}
	}
}