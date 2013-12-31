<?php
class WaermetauscherController extends Zend_Controller_Action {
	public function init() {
		$this->view->showVor = false; // Vorschläge werden noch nicht angezeigt
	}
	public function indexAction() {
		$this->view->title = "ProduktberaterPufferspeicher";
		
		$form = new Application_Form_ProduktberaterPs ();
		$form->setMethod ( 'post' );
		
		$this->view->produktberaterPs = $form;
		
		if ($this->_request->isPost ()) {
			$formData = $this->_request->getPost ();
			
			if ($form->isValid ( $formData )) {
				$typ = $form->getValue ( 'Typ' );
				$speicherinhalt = $form->getValue ( 'Speicherinhalt' );
				$leergewicht = $form->getValue ( 'Leergewicht' );
				$anschlussKw = $form->getValue ( 'AnschlussKaltwasser' );
				$anschlussWm = $form->getValue ( 'AnschlussWarmwasser' );
				$anschlussLs = $form->getValue ( 'AnschlussLadestutzen' );
				$anschlussZk = $form->getValue ( 'AnschlussZirkulation' );
				$anschlussTm = $form->getValue ( 'AnschlussThermometer' );
				
				$this->view->showVor = true; // Vorschläge werden angezeigt
					                             
				// TODO
					                             // Datenbankabfragen
					                             // Suchergebnisse anzeigen lassen
			}
		}
	}
	public function vvxAction() {
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		if (null != $art) {
			// Artikeldaten aus db auslesen und aufbereiten
			// Statement: SELECT * FROM Pufferspeicher WHERE Kategorie = 'VVX' AND ID like ?, $art;
			$entries = array ();
			$art_name = "Testartikel"; // $entries['Artikelname'];
			$art_dim = 503; // $entries['Fassungsvermögen'];
			$art_conn_zirk = 40; // $entries['Anschluss_Zirkulation'];
			$art_conn_cold = 30; // $entries['Anschluss_Kaltwasser'];
			$art_conn_warm = 30; // $entries['Anschluss_Warmwasser'];
			$art_conn_load = 30; // $entries['Anschluss_Ladestutzen'];
			$art_conn_sens = 30; // $entries['Anschluss_Thermometer'];
			$art_height = 1230; // $entries['Maximale Höhe'];
			$art_width = 123; // $entries['Maximale Breite'];
			
			$container = array (
					$art,
					$art_name,
					$art_dim,
					$art_height,
					$art_width,
					$art_conn_warm,
					$art_conn_cold,
					$art_conn_zirk,
					$art_conn_load,
					$art_conn_sens 
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
	public function lasAction() {
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		if (null != $art) {
			// Artikeldaten aus db auslesen und aufbereiten
			// Statement: SELECT * FROM Pufferspeicher WHERE Kategorie = 'LAS' AND ID like ?, $art;
			$entries = array ();
			$art_name = "Testartikel"; // $entries['Artikelname'];
			$art_dim = 503; // $entries['Fassungsvermögen'];
			$art_conn_zirk = 40; // $entries['Anschluss_Zirkulation'];
			$art_conn_cold = 30; // $entries['Anschluss_Kaltwasser'];
			$art_conn_warm = 30; // $entries['Anschluss_Warmwasser'];
			$art_conn_load = 30; // $entries['Anschluss_Ladestutzen'];
			$art_conn_sens = 30; // $entries['Anschluss_Thermometer'];
			$art_height = 1230; // $entries['Maximale Höhe'];
			$art_width = 123; // $entries['Maximale Breite'];
			
			$container = array (
					$art,
					$art_name,
					$art_dim,
					$art_height,
					$art_width,
					$art_conn_warm,
					$art_conn_cold,
					$art_conn_zirk,
					$art_conn_load,
					$art_conn_sens 
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
}