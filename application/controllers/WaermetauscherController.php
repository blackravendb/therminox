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
					$einsatzgbt = $form->getValue('Einsatzgebiet');
					$anschluss = $form->getValue('Anschluss'); 
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
						$wtmapper->setEinsatzgebiet($einsatzgbt); 
					}
					
					if (count($anschluss) != 3) { 
						$wtmapper->setAnschluss($anschluss); 
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
					
					$produkte = $wtmapper->getWaermetauscher();
					
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
			//TODO Ausnahmen abfangen! ->schlumpfhandling -.-
			if (true) {
				$db_mapper = new Application_Model_WaermetauscherMapper ();
				$data_object = $db_mapper->getWaermetauscherByModel ( $art );
				$this->view->dbdata = $data_object;
			} else {
				$this->view->message = 'Artikel konnte nicht gefunden werden';
				if (isset ( $_SERVER ['HTTP_REFERER'] )) {
					$this->view->link = $_SERVER ['HTTP_REFERER'];
				} else {
					$this->view->link = '/Waermetauscher';
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
			
			$this->view->form = $form;
		}
		public function entfernenAction() { /*
		   * Artikeldaten aus Registry/Session laden $artID = $_SESSION['artikel']; $artID = $artID['ID']; if(buttonpushed){ Query: DELETE FROM artikel WHERE artikelID IN(SELECT artikelID	FROM artikel WHERE artikelID = '$artID' ); } $this->view->artikel = $_SESSION['artikel'];
		   */
		}
	}




