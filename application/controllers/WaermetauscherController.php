 <?php
	class WaermetauscherController extends Zend_Controller_Action {
		public function init() {
			$this->view->showVor = false;
			$this->view->keineVorschläge = false;
		}
		public function indexAction() {
			$this->view->title = "ProduktberaterWärmetauscher";
			
			$form = new Application_Form_ProduktberaterWt ();
			
			$form->setMethod ( 'post' );
			
			$this->view->produktberaterWt = $form;
			
			if ($this->_request->isPost ()) {
				$formData = $this->_request->getPost ();
				
				if ($form->isValid ( $formData )) {
					$minTemp = $form->getValue ( 'TemperaturMin' );
					$maxTemp = $form->getValue ( 'TemperaturMax' );
					$einsatzgbt = $form->getValue ( 'Einsatzgebiet' );
					$anschluss = $form->getValue ( 'Anschluss' );
					$minHeight = $form->getValue ( 'HoeheMin' );
					$maxHeight = $form->getValue ( 'HoeheMax' );
					$minWidth = $form->getValue ( 'BreiteMin' );
					$maxWidth = $form->getValue ( 'BreiteMax' );
					
					$wtmapper = new Application_Model_WaermetauscherMapper ();
					
					if (! empty ( $minTemp )) {
						$wtmapper->setTemperaturMin ( $minTemp );
					}
					
					if (! empty ( $maxTemp )) {
						$wtmapper->setTemperaturMax ( $maxTemp );
					}
					
					if (! (strcmp ( $einsatzgbt, 'Bitte wählen' ) == 0)) {
						$wtmapper->setEinsatzgebiet ( $einsatzgbt );
					}
					
					if (count ( $anschluss ) != 3) {
						$wtmapper->setAnschluss ( $anschluss );
					}
					
					if (! empty ( $minHeight )) {
						$wtmapper->setHoeheMin ( $minHeight );
					}
					
					if (! empty ( $maxHeight )) {
						$wtmapper->setHoeheMax ( $maxHeight );
					}
					
					if (! empty ( $minWidth )) {
						$wtmapper->setBreiteMin ( $minWidth );
					}
					
					if (! empty ( $maxWidth )) {
						$wtmapper->setBreiteMax ( $maxWidth );
					}
					
					$produkte = $wtmapper->getWaermetauscher ();
					
					if (! empty ( $produkte )) {
						$this->view->vorschläge = $produkte;
					} else {
						$this->view->keineVorschläge = true;
					}
					
					$this->view->showVor = true; // Vorschläge werden angezeigt
				}
			}
		}
		public function geloetetAction() {
			$request = $this->getRequest ();
			$art = $request->getParam ( 'artikel' );
			// TODO Ausnahmen abfangen! ->schlumpfhandling -.-
			if (true) {
				$db_mapper = new Application_Model_WaermetauscherMapper ();
				$data_object = $db_mapper->getWaermetauscherByModel ( $art );
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
		public function geschraubtAction() {
			// befindet sich alles im view da statische seite
		}
		public function rohrbuendelAction() {
			// befindet sich alles im view da statische seite
		}
		public function bearbeitenAction() {
			// action body
		}
		public function hinzufuegenAction() {
			$form = new Application_Form_WtErstellen ();
			
			if ($this->_request->isPost ()) {
				$formData = $this->_request->getPost ();
				
				if ($form->isValid ( $formData )) {
					$form->populate ( $_POST );
					
					$modell = $form->getValue ( 'Model' );
					$einsatzgbt = $form->getValue ( 'Einsatzgebiet' );
					$conn = $form->getValue ( 'Anschluss' );
					$material = $form->getValue ( 'Stutzenmaterial' );
					$temp = $form->getValue ( 'Temperatur' );
					$druck = $form->getValue ( 'Betriebsdruck' );
					$height = $form->getValue ( 'Hoehe' );
					$width = $form->getValue ( 'Breite' );
					
					$newWT = new Application_Model_Waermetauscher ();
					$newWT->setModel ( $modell );
					$newWT->setTemperatur ( $temp );
					$newWT->setBetriebsdruck ( $druck );
					$newWT->setStutzenmaterial ( $material );
					$newWT->setHoehe ( $height );
					$newWT->setBreite ( $width );
					
					foreach ( $einsatzgbt as $gebiet ) {
						$eingebiet = new Application_Model_WaermetauscherEinsatzgebiet ();
						$eingebiet->setEinsatzgebiet ( $gebiet );
						$newWT->insertWaermetauscherEinsatzgebiet ( $eingebiet );
					}
					foreach ( $conn as $anschluss ) {
						$einanschl = new Application_Model_WaermetauscherAnschluss ();
						$einanschl->setAnschluss ( $anschluss );
						$newWT->insertWaermetauscherAnschluss ( $einanschl );
					}
					
					$plates = $form->getValue ( 'plates' );
					$length = $form->getValue ( 'length' );
					$weight = $form->getValue ( 'weight' );
					$area = $form->getValue ( 'area' );
					
					$cat = new Application_Model_WaermetauscherUnterkategorie();
					$cat->setLaenge($length);
					$cat->setPlatten($plates);
					$cat->setFlaeche($area);
					$cat->setLeergewicht($weight);
					
					$newWT->insertWaermetauscherUnterkategorie($cat);
					
					$db_mapper = new Application_Model_WaermetauscherMapper ();
					$db_mapper->insertWaermetauscher ( $newWT );
				}
			}
			
			$this->view->form = $form;
		}
	}




