<?php
class PufferspeicherController extends Zend_Controller_Action {
	public function init() {
		$this->view->showVor = false; // Vorschläge werden noch nicht angezeigt
		$this->view->keineVorschläge = false;
	}
	public function indexAction() {
		$this->view->title = "ProduktberaterPufferspeicher";
		
		$form = new Application_Form_ProduktberaterPs ();
		
		$form->setMethod ( 'post' );
		
		$this->view->produktberaterPs = $form;
		
		if ($this->_request->isPost ()) {
			$formData = $this->_request->getPost ();
			
			if ($form->isValid ( $formData )) {
				$einsatzgbt = $form->getValue ( 'Einsatzgebiet' );
				$minSpeicherinhalt = $form->getValue ( 'minSpeicherinhalt' );
				$maxSpeicherinhalt = $form->getValue ( 'maxSpeicherinhalt' );
				$minDruck = $form->getValue ( 'minDruck' );
				$maxDruck = $form->getValue ( 'maxDruck' );
				
				$wtmapper = new Application_Model_PufferspeicherMapper ();
				
				if (! (strcmp ( $einsatzgbt, 'Bitte wählen' ) == 0)) {
					$wtmapper->setEinsatzgebiet ( $einsatzgbt );
				}
				
				if (! empty ( $minSpeicherinhalt )) {
					$wtmapper->setSpeicherinhaltMin ( $minSpeicherinhalt );
				}
				
				if (! empty ( $maxSpeicherinhalt )) {
					$wtmapper->setSpeicherinhaltMax ( $maxSpeicherinhalt );
				}
				
				if (! empty ( $minDruck )) {
					$wtmapper->setBetriebsdruckMin ( $minDruck );
				}
				
				if (! empty ( $maxDruck )) {
					$wtmapper->setBetriebsdruckMax ( $maxDruck );
				}
				
				$produkte = $wtmapper->getPufferspeicher ();
				
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
			$db_mapper = new Application_Model_PufferspeicherMapper ();
			$data_object = $db_mapper->getPufferspeicherByModel ( $art );
			
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
	public function hinzufuegenAction() {
		$form = new Application_Form_PsErstellen ();
		
		if ($this->_request->isPost ()) {
			$formData = $this->_request->getPost ();
			
			if ($form->isValid ( $formData )) {
				
				$modell = $form->getValue ( 'Model' );
				$einsatzgbt = $form->getValue ( 'Einsatzgebiet' );
				$speicherinhalt = $form->getValue ( 'Speicherinhalt' );
				$leergewicht = $form->getValue ( 'Leergewicht' );
				$temp = $form->getValue ( 'TemperaturMax' );
				$druck = $form->getValue ( 'Betriebsdruck' );
				
				$newPS = new Application_Model_Pufferspeicher ();
				$newPS->setModel ( $modell );
				$newPS->setSpeicherinhalt ( $speicherinhalt );
				$newPS->setTemperaturMax ( $temp );
				$newPS->setBetriebsdruck ( $druck );
				$newPS->setLeergewicht ( $leergewicht );
						
				foreach ( $einsatzgbt as $gebiet ) {
					$eingebiet = new Application_Model_PufferspeicherEinsatzgebiet ();
					$eingebiet->setEinsatzgebiet ( $value );
					
					$newPS->insertEinsatzgebiet ( $eingebiet );
				}
				
				$db_mapper = new Application_Model_PufferspeicherMapper ();
				$db_mapper->insertPufferspeicher ( $newPS );
			}
		}
		$this->view->form = $form;
	}
}
