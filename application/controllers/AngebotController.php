<?php
class AngebotController extends Zend_Controller_Action {
	public function init() {
		require_once 'Cart/ShoppingCart.php';
		session_start ();
	}
	public function indexAction() {
	
	}
	
	public function erstellenAction(){
		
	}
	
	public function anzeigenAction() {
		if (isset ( $_SESSION ['__cart'] ) && $_SESSION ['__cart'] instanceof ShoppingCartIf) {
			$cart = $_SESSION ['__cart'];
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
			if (isset ( $_SESSION ['__cart'] ) && $_SESSION ['__cart'] instanceof ShoppingCartIf) {
				$cart = $_SESSION ['__cart'];
			} else {
				$cart = new ShoppingCart ();
			}
			$cart->addItem ( $artnr );
			$_SESSION ['__cart'] = $cart;
			
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









