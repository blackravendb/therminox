<?php
class AngebotController extends Zend_Controller_Action {
	public function init() {
		require_once 'Cart/ShoppingCart.php';
	}
	public function indexAction() {
		$_mapper = new Application_Model_AngebotskorbMapper ();
		$email = Zend_Auth::getInstance ()->getIdentity ()->email;
		$_offers = $_mapper->getAngebotskorbByEmail ( $email );
		$this->view->_offers = $_offers;
	}
	public function erstellenAction() {
		$request = $this->getRequest ();
		$_art_nr = $request->getParam ( 'artikelnummer' );
		$_cat = null;
		$_art = null;
		
		$artmapper = new Application_Model_ArtikelMapper ();
		$_art = $artmapper->getArtikelByArtikelnummer ( $_art_nr );
		$_art = $_art->getModel ();
		
		$this->view->artID = $_art;
		if (substr_compare ( $_art, 'BH', 0, 2, false ) === 0) {
			$_cat = "Wärmetauscher";
			$this->view->artCat = $_cat;
		}
		if (substr_compare ( $_art, 'VV', 0, 2, false ) === 0) {
			$_cat = "Pufferspeicher";
			$this->view->artCat = $_cat;
		}
		if (substr_compare ( $_art, 'LA', 0, 2, false ) === 0) {
			$_cat = "Pufferspeicher";
			$this->view->artCat = $_cat;
		}
		
		$form = new Application_Form_AngebotErstellen ();
		
		$form->setMethod ( 'post' );
		$_action = '/Angebot/erstellen/artikelnummer/' . $_art_nr;
		$form->setAction ( $_action );
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
					
					$_offer = new Application_Model_Angebot ();
					$_offer->setArtikelnummer ( $_art_nr );
					$_offer->setBemerkung ( $form_message );
					$_SESSION ['angebotskorb']->insertAngebot ( $_offer );
					$this->_redirect($this->_request->getPost('return'));
					
				}
				if ($form->submit->isChecked ()) {
					if (isset ( $_SESSION ['angebotskorb'] )) {
						$angebotskorb = $_SESSION ['angebotskorb'];
					}
					if(!isset($_SESSION['angebotskorb'])){
						$angebotskorb = new Application_Model_Angebotskorb();
						$email = Zend_Auth::getInstance ()->getIdentity ()->email;
						$angebotskorb->setBenutzer_email ( $email );
					}
					$_offer = new Application_Model_Angebot ();
					$_offer->setArtikelnummer ( $_art_nr );
					$_offer->setBemerkung ( $form_message );
					$angebotskorb->insertAngebot ( $_offer );
					
					$_mapper = new Application_Model_AngebotskorbMapper ();
					$_mapper->insertAngebotskorb ( $angebotskorb );
					
					$this->_redirect ( 'angebot/' );
				}
			}
		}
	}
	public function anzeigenAction() {
		$request = $this->getRequest ();
		$_offerID = $request->getParam ( 'id' );
		$this->view->offerID = $_offerID;
		
		$_mapper = new Application_Model_AngebotskorbMapper ();
		$email = Zend_Auth::getInstance ()->getIdentity ()->email;
		$_offers = $_mapper->getAngebotskorbByEmail ( $email );
		$_articleIDs = array ();
		
		foreach ( $_offers as $_offer ) {
			if ($_offerID === $_offer->getId ()) {
				$_articleIDs = $_offer->getAngebot ();
			}
		}
		
		$_articles = array ();
		$_mapper = new Application_Model_ArtikelMapper ();
		
		foreach ( $_articleIDs as $_articleID ) {
			$_articles = $_mapper->getArtikelByArtikelnummer ( $_articleID );
		}
		
		$this->view->articles = $_articles;
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
	}
	public function removeAction() {
		$this->_redirect ( Angebot );
		// $this->_redirect ( $_SERVER ['HTTP_REFERER'] );
	}
}