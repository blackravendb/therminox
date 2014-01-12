<?php

class PufferspeicherController extends Zend_Controller_Action
{

    public function init()
    {
       $this->view->showVor = false; //Vorschläge werden noch nicht angezeigt
       $this->view->keineVorschläge = false;
    }

    public function indexAction(){
			$this->view->title = "ProduktberaterPufferspeicher";
     	
     		$form = new Application_Form_ProduktberaterPs();
			
			$form->setMethod ( 'post' );
			
			$this->view->produktberaterPs = $form;
			
			if ($this->_request->isPost ()) {
				$formData = $this->_request->getPost ();
				
				if ($form->isValid ( $formData )) {
					$einsatzgbt = $form->getValue('Einsatzgebiet');
					$minSpeicherinhalt = $form->getValue ( 'minSpeicherinhalt' );
					$maxSpeicherinhalt = $form->getValue ( 'maxSpeicherinhalt' );
					$minDruck = $form->getValue ( 'minDruck' );
					$maxDruck = $form->getValue ( 'maxDruck' );
					
					$wtmapper = new Application_Model_PufferspeicherMapper ();

					if (! (strcmp ( $einsatzgbt, 'Bitte wählen' ) == 0)) { 
						$wtmapper->setEinsatzgebiet($einsatzgbt); 
					}
					
					if (! empty ( $minSpeicherinhalt )) {
						$wtmapper->setSpeicherinhaltMin ( $minSpeicherinhalt );
					}
					
					if (! empty ( $maxSpeicherinhalt )) {
						$wtmapper->setSpeicherinhaltMax( $maxSpeicherinhalt );
					}
					
					if (! empty ( $minDruck )) {
						$wtmapper->setBetriebsdruckMin ( $minDruck );
					}
					
					if (! empty ( $maxDruck )) {
						$wtmapper->setBetriebsdruckMax ( $maxDruck );
					}
					
					$produkte = $wtmapper->getPufferspeicher();
					
					if (! empty ( $produkte )) { 
						$this->view->vorschläge = $produkte;
					} else {
						$this->view->keineVorschläge = true;
					}
					
					$this->view->showVor = true; // Vorschläge werden angezeigt
        		}
			}
		}

	public function anzeigenAction() {
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		if (null != $art) {
			$db_mapper = new Application_Model_PufferspeicherMapper();
			$data_object = $db_mapper->getPufferspeicherByModel($art);
			
			
			$this->view->dbdata = $data_object;
		} else {
			$this->view->message = 'Artikel konnte nicht gefunden werden';
			if (isset ( $_SERVER ['HTTP_REFERER'] )) {
				$this->view->link = $_SERVER ['HTTP_REFERER'];
			} else {
				$this->view->link = '/waermetauscher';
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
				$this->view->link = '/waermetauscher';
			}
		}
	}
	
	public function hinzufuegenAction() {
		$form = new Application_Form_PsErstellen();
		
		$this->view->form = $form;
	}
}
