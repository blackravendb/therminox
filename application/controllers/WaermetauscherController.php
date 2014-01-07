 <?php
	class WaermetauscherController extends Zend_Controller_Action {
		public function init() { // session_start();
			require_once 'Cart/ShoppingCart.php';
			$this->view->showVor = false;
			$this->view->keineVorschläge = false;
		}
		public function indexAction() {
			$this->view->title = "ProduktberaterWärmetauscher";
			/*
			 * $minTemp = 155; $maxTemp = 195; $minHeight = 170; $maxHeight = 1100; $minWidth = 70; $maxWidth = 400; $minLength = 20; $maxLength = 500;
			 */
     
     	/*
        $form = new Application_Form_ProduktberaterWt(array('minTemp' => '155', 'maxTemp' => '195', 
        												'minHeight' => '170', 'maxHeight' => '1100', 
        												'minWidth' => '70', 'maxWidth' => '400', 
        												'minLength' => '20', 'maxLength' => '500'));
       */
     	
     	$form = new Application_Form_ProduktberaterWt ();
			
			$form->setMethod ( 'post' );
			
			$this->view->produktberaterWt = $form;
			
			if ($this->_request->isPost ()) {
				$formData = $this->_request->getPost ();
				
				if ($form->isValid ( $formData )) {
					$minTemp = $form->getValue ( 'TemperaturMin' );
					$maxTemp = $form->getValue ( 'TemperaturMax' );
					$einsatzgbt = $form->getValue ( 'Einsatzgebiet' );
					$anschluss = $form->getValue ( 'Anschluss' ); // Nur angehackte Werte werden übergeben
					$minHeight = $form->getValue ( 'HoeheMin' );
					$maxHeight = $form->getValue ( 'HoeheMax' );
					$minWidth = $form->getValue ( 'BreiteMin' );
					$maxWidth = $form->getValue ( 'BreiteMax' );
					
					$anzahlAnschlüsse = 0;
					
					$wtmapper = new Application_Model_WaermetauscherMapper ();
					
					if (! empty ( $minTemp )) {
						$wtmapper->setTemperaturMin ( $minTemp );
					}
					
					if (! empty ( $maxTemp )) {
						$wtmapper->setTemperaturMax ( $maxTemp );
					}
					
					if (! (strcmp ( $einsatzgbt, 'Bitte wählen' ) == 0)) { // funktioniert
						$wtmapper->setEinsatzgebiet ( $einsatzgbt ); // wenn standartwert "bitte wählen" dasteht nicht set!
					}
					
					if (count ( $anschluss ) != 3) { // TODO
						$wtmapper->setAnschluss ( $anschluss ); // if (kein set, wenn alle angehackt)
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
					
					$produkte = $wtmapper->getWaermetauscher (); // funktioniert, ist immer ein Array
					
					if (! empty ( $produkte )) { // Sobald nicht alle 3 Anschlüsse ausgewählt sind, ist das Array leer
						$this->view->vorschläge = $produkte;
					} else {
						$this->view->keineVorschläge = true;
					}
					
					$this->view->showVor = true; // Vorschläge werden angezeigt
					
					/*
					 * $tempVal = $form->getElement('tempVal'); $heightVal = $form->getElement('heightVal'); $widthVal = $form->getElement('widthVal'); $lengthVal = $form->getElement('lengthVal');
					 */
      			
        		/*
      			if(!$anschluss1->isChecked() && !$anschluss2->isChecked() && !$anschluss3->isChecked()){
      				//$anschluss->setChecked(array('3/8" IG', '1/2" AG', '3/4" AG'));
      				 //$anschluss->addElement(array('checkedValue' => '3/8" IG'));
      				 $anschluss1->setChecked(true);
      				 $anschluss2->setChecked(true);
      				 $anschluss3->setChecked(true);
      			}
      			
      			if($maxHeight){
   					$maxHeight->setValue($form->getMaxHeight());
      				$maxHeight = $form->getMaxHeight();
      			}
      			
      			if($maxWidth == null){ //TODO evtl ===
      				$maxWidth->setValue($form->getMaxWidth());
      				$maxWidth = $form->getMaxWidth();
      			}
      			
      			if($maxLength == null){
      				$maxLength->setValue($form->getMaxLength());
      				$maxLength = $form->getMaxLength();
      			}
      			*/
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




