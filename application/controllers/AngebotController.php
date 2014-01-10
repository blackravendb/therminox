<?php
class AngebotController extends Zend_Controller_Action {
	public function init() {
		require_once 'Cart/ShoppingCart.php';
		
	}
	public function indexAction() {
	}
	public function erstellenAction() {
		$request = $this->getRequest ();
		$_art = $request->getParam ( 'artikel' );
		$_cat;
		
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
		
		if ($this->_request->isPost ()) {
			$formData = $this->getRequest ()->getPost ();
			
			if ($formData ['submit'] == 'addMore') {
				// in session zwischenspeichern
				$_SESSION ['button'] = "weitere artikel adden";
			}
			if ($formData ['submit'] == 'submit') {
				// in db abspeichern
				$_SESSION ['button'] = "in db speichern";
			}
				if ($form->isValid ( $formData )) {
					$form_message = $form->getValue ( 'extraInfo' );
				}
				$cart = new ShoppingCartIf ();
				$cart->addItem ( $_art, $_cat, $form_message );
				
				$_SESSION ['angebotskorb'] = $cart;
				
				$this->_redirect ( 'angebot/anzeigen' );
				
		}
		
		$this->view->form = $form;
	}
	public function anzeigenAction() {
		if (isset ( $_SESSION ['angebotskorb'] ) && $_SESSION ['angebotskorb'] instanceof ShoppingCartIf) {
			$cart = $_SESSION ['angebotskorb'];
			$this->view->cartContents = $cart->getCartContents ();
		} else {
			$this->view->cartContents = array ();
		}
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









