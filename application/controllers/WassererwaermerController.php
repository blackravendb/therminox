<?php
class WassererwaermerController extends Zend_Controller_Action {
	public function init() {
		$this->view->showVor = false; // Vorschläge werden noch nicht angezeigt
	}
	public function indexAction() {
		$this->view->title = "ProduktberaterWasserwärmer";
		
		$form = new Application_Form_ProduktberaterWw ();
		$form->setMethod ( 'post' );
		
		$this->view->produktberaterWw = $form;
		
		if ($this->_request->isPost ()) {
			$formData = $this->_request->getPost ();
			
			if ($form->isValid ( $formData )) {
				$typ = $form->getValue ( 'Typ' );
				$heizwendel = $form->getValue ( 'Heizwendel' );
				$speicherinhalt = $form->getValue ( 'Speicherinhalt' );
				$leergewicht = $form->getValue ( 'Leergewicht' );
				$anschlussKw = $form->getValue ( 'AnschlussKaltwasser' );
				$anschlussWw = $form->getValue ( 'AnschlussWarmwasser' );
				
				$this->view->showVor = true; // Vorschläge werden angezeigt
					                             
				// TODO
					                             // Datenbankabfragen
					                             // Suchergebnisse anzeigen lassen
			}
		}
	}
	public function vveAction() {
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		if (null != $art) {
			// Artikeldaten aus db auslesen und aufbereiten
			// Statement: SELECT * FROM Wassererwaermer WHERE Kategorie = 'VVE' AND ID like ?, $art;
			$entries = array ();
			$art_name = "Testartikel"; // $entries['Artikelname'];
			$art_sys = 1; // $entries['Kreislauf'];
			$art_dim = 503; // $entries['Fassungsvermögen'];
			$art_weight = 234; // $entries['Gewicht'];
			$art_conn_zirk = 4; // $entries['Anschluss_Zirkulation'];
			$art_conn_cold = 3; // $entries['Anschluss_Kaltwasser'];
			$art_conn_warm = 3; // $entries['Anschluss_Warmwasser'];
			$art_height = 1230; // $entries['Maximale Höhe'];
			$art_width = 123; // $entries['Maximale Breite'];
			
			$container = array (
					$art,
					$art_name,
					$art_sys,
					$art_dim,
					$art_weight,
					$art_height,
					$art_width,
					$art_conn_warm,
					$art_conn_cold,
					$art_conn_zirk 
			);
			
			$this->view->art_display = $container;
		} else {
			$this->view->message = 'Artikel konnte nicht gefunden werden';
			if (isset ( $_SERVER ['HTTP_REFERER'] )) {
				$this->view->link = $_SERVER ['HTTP_REFERER'];
			} else {
				$this->view->link = '/Waermetauscher';
			}
		}
	}
	public function shiAction() {
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		if (null != $art) {
			// Artikeldaten aus db auslesen und aufbereiten
			// Statement: SELECT * FROM Wassererwaermer WHERE Kategorie = 'SHI' AND ID like ?, $art;
			$entries = array ();
			$art_name = "Testartikel"; // $entries['Artikelname'];
			$art_sys = 1; // $entries['Kreislauf'];
			$art_dim = 503; // $entries['Fassungsvermögen'];
			$art_weight = 234; // $entries['Gewicht'];
			$art_conn_zirk = 4; // $entries['Anschluss_Zirkulation'];
			$art_conn_cold = 3; // $entries['Anschluss_Kaltwasser'];
			$art_conn_warm = 3; // $entries['Anschluss_Warmwasser'];
			$art_height = 1230; // $entries['Maximale Höhe'];
			$art_width = 123; // $entries['Maximale Breite'];
			
			$container = array (
					$art,
					$art_name,
					$art_sys,
					$art_dim,
					$art_weight,
					$art_height,
					$art_width,
					$art_conn_warm,
					$art_conn_cold,
					$art_conn_zirk 
			);
			
			$this->view->art_display = $container;
		} else {
			$this->view->message = 'Artikel konnte nicht gefunden werden';
			if (isset ( $_SERVER ['HTTP_REFERER'] )) {
				$this->view->link = $_SERVER ['HTTP_REFERER'];
			} else {
				$this->view->link = '/Waermetauscher';
			}
		}
	}
	public function vviAction() {
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		if (null != $art) {
			// Artikeldaten aus db auslesen und aufbereiten
			// Statement: SELECT * FROM Wassererwaermer WHERE Kategorie = 'VVI' AND ID like ?, $art;
			$entries = array ();
			$art_name = "Testartikel"; // $entries['Artikelname'];
			$art_sys = 1; // $entries['Kreislauf'];
			$art_dim = 503; // $entries['Fassungsvermögen'];
			$art_weight = 234; // $entries['Gewicht'];
			$art_conn_zirk = 4; // $entries['Anschluss_Zirkulation'];
			$art_conn_cold = 3; // $entries['Anschluss_Kaltwasser'];
			$art_conn_warm = 3; // $entries['Anschluss_Warmwasser'];
			$art_height = 1230; // $entries['Maximale Höhe'];
			$art_width = 123; // $entries['Maximale Breite'];
			
			$container = array (
					$art,
					$art_name,
					$art_sys,
					$art_dim,
					$art_weight,
					$art_height,
					$art_width,
					$art_conn_warm,
					$art_conn_cold,
					$art_conn_zirk 
			);
			
			$this->view->art_display = $container;
		} else {
			$this->view->message = 'Artikel konnte nicht gefunden werden';
			if (isset ( $_SERVER ['HTTP_REFERER'] )) {
				$this->view->link = $_SERVER ['HTTP_REFERER'];
			} else {
				$this->view->link = '/Waermetauscher';
			}
		}
	}
	
	public function hinzufuegen() {
		$form = new Application_Form_WwErstellen();
		
		$this->view->form = $form;
	}
}







