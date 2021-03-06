<?php
class AdminController extends Zend_Controller_Action {
	public function init() {

	}
	public function indexAction() {
	}
	public function showwaermetauscherAction() {
		$db_mapper = new Application_Model_WaermetauscherMapper ();
		$data_object = $db_mapper->getWaermetauscher ();
		$this->view->dbdata = $data_object;
	}
	public function showpufferspeicherAction() {
		$db_mapper = new Application_Model_PufferspeicherMapper ();
		$data_object = $db_mapper->getPufferspeicher ();
		$this->view->dbdata = $data_object;
	}
	public function changewaermetauscherAction() {
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		$db_mapper = new Application_Model_WaermetauscherMapper ();
		$data_object = $db_mapper->getWaermetauscherByModel ($art);
		
		$form = new Application_Form_WtBearbeiten ();
		$form->setDbdata ( $data_object );
		$form->startform ();
		
		$this->view->wtbearbeiten = $form;
		
		if ($this->_request->isPost ()) {
			$formData = $this->_request->getPost ();
			
			if ($form->isValid ( $formData )) {
				$form->populate ( $_POST );
				
				if ($form->artikelAendern->isChecked ()) {
					
					$artikelname = $form->getValue ( 'Artikelname' );
					$temp = $form->getValue ( 'Temperatur' );
					$einsatzgbt = $form->getValue ( 'Einsatzgebiete' );
					$anschluss = $form->getValue ( 'Anschluss' );
					$height = $form->getValue ( 'Hoehe' );
					$width = $form->getValue ( 'Breite' );
					$betriebsdruck = $form->getValue( 'Betriebsdruck' );
					$stutzenmaterial = $form->getValue ( 'Stutzenmaterial' );
					
					$egAlt = $data_object->getWaermetauscherEinsatzgebiet ();
					$anAlt = $data_object->getWaermetauscherAnschluss ();
					
					$data_object->setModel ( $artikelname );
					$data_object->setBetriebsdruck($betriebsdruck);
					$data_object->setTemperatur ( $temp );
					$data_object->setStutzenmaterial($stutzenmaterial);
					$data_object->setHoehe($height);
					$data_object->setBreite($width);					
					
					// EinsatzgebietObjekte erstellen und einfügen //TODO Dennis
					//Einsatzgebiete löschen
					$einsatzgebiet_alt = $data_object->getWaermetauscherEinsatzgebiet();
					if(!empty($einsatzgebiet_alt)){
						foreach($einsatzgebiet_alt as $value) {
							$data_object->deleteWaermetauscherEinsatzgebiet($value);
						}
					}
					
					if (!empty ( $einsatzgbt )) {
						foreach ( $einsatzgbt as $value ) {
							$einsatzgbtObj = new Application_Model_WaermetauscherEinsatzgebiet ();
							$einsatzgbtObj->setEinsatzgebiet ( $value );
							
							$data_object->insertWaermetauscherEinsatzgebiet ( $einsatzgbtObj );
						}
					}
					
					//Anschlüsse löschen
					$anschluss_alt = $data_object->getWaermetauscherAnschluss();
					if(!empty($anschluss_alt)){
						foreach($anschluss_alt as $value) {
							$data_object->deleteWaermetauscherAnschluss($value);
						}
					}
										
					// AnschlussObjekte erstellen und einfügen //TODO Dennis
					if (! empty ( $anschluss )) {
						foreach ( $anschluss as $value ) {
							$anschObj = new Application_Model_WaermetauscherAnschluss ();
							$anschObj->setAnschluss ( $value );
							
							$data_object->insertWaermetauscherAnschluss ( $anschObj );
						}
					}
					
					$this->view->showMessage = $db_mapper->updateWaermetauscher ( $data_object );
				}
			}
		}
		if ($form->unterkategorien->isChecked ()) { // TODO
			$unterkategorien = $data_object->getWaermetauscherUnterkategorie ();
			
			$this->view->kategorien = $unterkategorien;
			$this->view->artikel = $data_object;
			$this->view->showUnterkategorien = true;
		}
		if ($form->unterkategorienHinzufuegen->isChecked ()) {
			$this->_redirect ( '/admin/unterkategorienhinzufuegen/artikel/' . $data_object->getModel());
		}
	}
	
	public function unterkategorienhinzufuegenAction(){
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		$db_mapper = new Application_Model_WaermetauscherMapper ();
		$data_object = $db_mapper->getWaermetauscherByModel ( $art );
		$unterkategorie = new Application_Model_WaermetauscherUnterkategorie();
		
		$form = new Application_Form_UnterkategorieHinzufuegen ();
		$form->startform ();
		
		$this->view->unterkategorieHinzufuegen = $form;
		
		if ($this->_request->isPost ()) {
			$formData = $this->_request->getPost ();
			
			if ($form->isValid ( $formData )) {
				$platten = $form->getValue('AnzahlPlatten');
				$laenge = $form->getValue('Laenge');
				$leergewicht = $form->getValue('Leergewicht');
				$flaeche = $form->getValue('Flaeche');
				
				if (! empty ( $leergewicht )) {
					$leergewicht = str_replace ( ",", ".", $leergewicht );
				}
				
				if (! empty ( $flaeche )) {
					$flaeche = str_replace ( ",", ".", $flaeche );
				}
				
				$unterkategorie->setPlatten( $platten );
				$unterkategorie->setLaenge($laenge);
				$unterkategorie->setLeergewicht ( $leergewicht );
				$unterkategorie->setFlaeche($flaeche);
				
				echo "Platte: $platten Laenge: $laenge Leergewicht: $leergewicht Flaeche: $flaeche"; 
				
				$data_object->insertWaermetauscherUnterkategorie($unterkategorie);
				$this->view->showMessage = $db_mapper->updateWaermetauscher($data_object);
				
			}
		}
	}
	
	public function deletewaermetauscherAction() {
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		$db_mapper = new Application_Model_WaermetauscherMapper ();
		$data_object = $db_mapper->getWaermetauscherByModel ( $art );
		
		try {
			$db_mapper->deleteWaermetauscher ( $data_object );
		} catch ( Exception $e ) {
			$_SESSION ['wtnotdelete'] = 1;
		}
		$this->_redirect ( '/Admin/showwaermetauscher' );
	}
	public function changewtunterkategorieAction() {
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' ); 
		$db_mapper = new Application_Model_WaermetauscherMapper ();
		$data_object = $db_mapper->getWaermetauscherByModel ( $art );
		$unterkategorien = $data_object->getWaermetauscherUnterkategorie ();
		$index = $_GET ["index"];
		$unterkategorie = $unterkategorien [$index];
		
		$form = new Application_Form_UnterkategorienBearbeiten ();
		$form->setDbdata ( $unterkategorie );
		$form->startform ();
		
		$this->view->wtunterkategorienbearbeiten = $form;
		
		if ($this->_request->isPost ()) {
			$formData = $this->_request->getPost ();
			
			if ($form->isValid ( $formData )) {
				$platten = $form->getValue ( 'AnzahlPlatten' );
				$laenge = $form->getValue ( 'Laenge' );
				$leergewicht = $form->getValue ( 'Leergewicht' );
				$flaeche = $form->getValue ( 'Flaeche' );
				$inhaltPrimaer = $form->getValue ( 'inhaltPrimaer' );
				$inhaltSekundaer = $form->getValue ( 'inhaltSekundaer' );
				
				$leergewicht = str_replace ( ",", ".", $leergewicht );
				$flaeche = str_replace ( ",", ".", $flaeche );
				
				if (! empty ( $inhaltPrimaer )) {
					$inhaltPrimaer = str_replace ( ",", ".", $inhaltPrimaer );
				}
				if (! empty ( $inhaltSekundaer )) {
					$inhaltSekundaer = str_replace ( ",", ".", $inhaltSekundaer );
				}
				
				$unterkategorie->setPlatten ( $platten );
				$unterkategorie->setLaenge ( $laenge );
				$unterkategorie->setLeergewicht ( $leergewicht );
				$unterkategorie->setFlaeche ( $flaeche );
				if (! empty ( $inhaltPrimaer )) {
					$unterkategorie->setInhaltPrimaer ( $inhaltPrimaer );
				}
				if (! empty ( $inhaltSekundaer )) {
					$unterkategorie->setInhaltSekundaer ( $inhaltSekundaer );
				}
				
				$db_mapper->updateWaermetauscher ( $data_object );
				
				$this->view->showMessageUn = true;
			}
		}
	}
	public function deletewtunterkategorieAction() { // TODO
		$request = $this->getRequest ();
		$art = $request->getParam ( '???' ); // TODO
	}
	public function changepufferspeicherAction() {
			
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		$db_mapper = new Application_Model_PufferspeicherMapper ();
		$data_object = $db_mapper->getPufferspeicherByModel ( $art );
		
		$form = new Application_Form_PsBearbeiten ();
		$form->setDbdata ( $data_object );
		$form->startform ();
		
		$this->view->psbearbeiten = $form;
		
		if($this->_request->isPost()){
			$formData = $this->_request->getPost();
		
		if ($form->isValid ( $formData )) {
			$form->populate($_POST);

			if($form->artikelAendern->isChecked()){ //funktioniert
				$artikelname = $form->getValue ( 'Artikelname' );
				$einsatzgbt = $form->getValue ( 'EinsatzgebietePs' );
				$speicherinhalt = $form->getValue ( 'Speicherinhalt' );
				$betriebsdruck = $form->getValue ('Betriebsdruck');
				$temperatur = $form->getValue('Temperatur');
				$leergewicht =$form->getValue('Leergewicht');
				
				$data_object->setModel($artikelname);
				$data_object->setSpeicherinhalt($speicherinhalt);
				$data_object->setLeergewicht($leergewicht);
				$data_object->setBetriebsdruck($betriebsdruck);
				$data_object->setTemperaturMax($temperatur);
				
				echo $data_object->getTemperaturMax();
				
				$einsatzgebiet_alt = $data_object->getEinsatzgebiet();
					if(!empty($einsatzgebiet_alt)){
						foreach($einsatzgebiet_alt as $value) {
							$data_object->deleteEinsatzgebiet($value);
						}
					}
					
					if (!empty ( $einsatzgbt )) {
						foreach ( $einsatzgbt as $value ) {
							$einsatzgbtObj = new Application_Model_PufferspeicherEinsatzgebiet ();
							$einsatzgbtObj->setEinsatzgebiet ( $value );
							
							$data_object->insertEinsatzgebiet ( $einsatzgbtObj );
						}
					}
					
					$this->view->showMessage = $db_mapper->updatePufferspeicher ( $data_object );
				}
			}
		}
	}
	
	public function deletepufferspeicherAction() {
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		$db_mapper = new Application_Model_PufferspeicherMapper ();
		$data_object = $db_mapper->getPufferspeicherByModel ( $art );
		
		try { // TODO Dennis
			$db_mapper->deletePufferspeicher ( $data_object );
		} catch ( Exception $e ) {
			$_SESSION ['psnotdelete'] = 1;
		}
		$this->_redirect ( '/Admin/showpufferspeicher' );
	}
	public function bearbeiten($attrib) { // TODO evtl löschen
	}
	public function anschluessebearbeitenAction() {
		$wtmapper = new Application_Model_WaermetauscherMapper ();
		$anschluesse = $wtmapper->getAnschlussListe ();
		
		$form = new Application_Form_AttributeBearbeiten ();
		$form->setDbdata ( $anschluesse );
		$form->startform ();
		
		$this->view->attributeBearbeiten = $form;
		
		if ($this->_request->isPost ()) {
			$formData = $this->_request->getPost ();
			
			if ($form->isValid ( $formData )) {
				$form->populate ( $_POST );
				
				if ($form->attributLoeschen->isChecked ()) {
					$anschLoeschen = $form->getValue ( 'AttributLoeschen' );
					if (! empty ( $anschLoeschen )) {
						foreach ( $anschLoeschen as $value ) { // TODO Dennis
							try {
								$wtmapper->deleteAnschluss ( $value );
							} catch ( Exception $e ) {
								$_SESSION ['anschlNotDelete'] = 1;
							}
						}
						$this->_redirect ( '/admin/anschluessebearbeiten' );
					}
				}
				
				if ($form->hinzufuegen->isChecked ()) {
					$anschHinzufuegen = $form->getValue ( 'attributHinzufuegen' ); // TODO Dennis
					if (! empty ( $anschHinzufuegen )) {
						try {
							$wtmapper->insertAnschluss ( $anschHinzufuegen );
							$this->_redirect ( '/admin/anschluessebearbeiten' );
						} catch ( Exception $e ) {
							$_SESSION ['anschlNotInsert'] = 1;
						}
					}
				}
			}
		}
	}
	public function einsatzgebietebearbeitenAction() { // TODO Auf Methode warten
		$wtmapper = new Application_Model_WaermetauscherMapper ();
		$einsatzgebiete = $wtmapper->getEinsatzgebietListe ();
		
		$form = new Application_Form_AttributeBearbeiten ();
		$form->setDbdata ( $einsatzgebiete );
		$form->startform ();
		
		$this->view->attributeBearbeiten = $form;
		
		if ($this->_request->isPost ()) {
			$formData = $this->_request->getPost ();
			
			if ($form->isValid ( $formData )) {
				$form->populate ( $_POST );
				
				if ($form->attributLoeschen->isChecked ()) {
					$einsatzgbtLoeschen = $form->getValue ( 'AttributLoeschen' );
					if (! empty ( $einsatzgbtLoeschen )) {
						foreach ( $einsatzgbtLoeschen as $value ) { // TODO Dennis
							try {
								$wtmapper->deleteEinsatzgebiet ( $value );
							} catch ( Exception $e ) {
								$_SESSION ['einsatzgbtNotInsert'] = 1;
							}
						}
						$this->_redirect ( '/admin/einsatzgebietebearbeiten' );
					}
				}
				if ($form->hinzufuegen->isChecked ()) {
					$einsatzgbtHinzufuegen = $form->getValue ( 'attributHinzufuegen' );
					if (! empty ( $einsatzgbtHinzufuegen )) {
						try {
							$wtmapper->insertEinsatzgebiet ( $einsatzgbtHinzufuegen );
							$this->_redirect ( '/Admin/einsatzgebietebearbeiten' );
						} catch ( Exception $e ) {
							$_SESSION ['einsatzgbtNotDelete'] = 1;
						}
					}
				}
			}
		}
	}
	public function stutzenmaterialbearbeitenAction() { // TODO Auf Methode warten
		$wtmapper = new Application_Model_WaermetauscherMapper ();
		$stutzenmaterial = $wtmapper->getStutzenmaterialListe ();
		
		$form = new Application_Form_AttributeBearbeiten ();
		$form->setDbdata ( $stutzenmaterial );
		$form->startform ();
		
		$this->view->attributeBearbeiten = $form;
		
		if ($this->_request->isPost ()) {
			$formData = $this->_request->getPost ();
			
			if ($form->isValid ( $formData )) {
				$form->populate ( $_POST );
				
				if ($form->attributLoeschen->isChecked ()) {
					$stutzenmaterialLoeschen = $form->getValue ( 'AttributLoeschen' );
					if (! empty ( $stutzenmaterialLoeschen )) {
						foreach ( $stutzenmaterialLoeschen as $value ) { // TODO Dennis
							try {
								$wtmapper->deleteStutzenmaterial ( $value );
							} catch ( Exception $e ) {
								$_SESSION ['stutzenmaterialNotDeleted'] = 1;
							}
						}
						$this->_redirect ( '/Admin/stutzenmaterialbearbeiten' );
					}
				}
				
				if ($form->hinzufuegen->isChecked ()) {
					$stutzenmaterialHinzufuegen = $form->getValue ( 'attributHinzufuegen' );
					if (! empty ( $stutzenmaterialHinzufuegen )) {
						try { // TODO Dennis
							$wtmapper->insertStutzenmaterial ( $stutzenmaterialHinzufuegen );
							$this->_redirect ( '/Admin/stutzenmaterialbearbeiten' );
						} catch ( Exception $e ) {
							$_SESSION ['stutzenmaterialNotInserted'] = 1;
						}
					}
				}
			}
		}
	}
	public function einsatzgebietepsbearbeitenAction() {
		$psmapper = new Application_Model_PufferspeicherMapper ();
		$einsatzgebiete = $psmapper->getEinsatzgebietListe ();
		
		$form = new Application_Form_AttributeBearbeiten ();
		$form->setDbdata ( $einsatzgebiete );
		$form->startform ();
		
		$this->view->attributeBearbeiten = $form;
		
		if ($this->_request->isPost ()) {
			$formData = $this->_request->getPost ();
			
			if ($form->isValid ( $formData )) {
				$form->populate ( $_POST );
				
				if ($form->attributLoeschen->isChecked ()) {
					$einsatzgbtLöschen = $form->getValue ( 'AttributLoeschen' );
					if (! empty ( $einsatzgbtLöschen )) {
						foreach ( $einsatzgbtLöschen as $value ) {
							try { // TODO Dennis
								$psmapper->deleteEinsatzgebiet ( $value );
							} catch ( Exception $e ) {
								$_SESSION ['einsatzgbtPsNotDeleted'] = 1;
							}
						}
						$this->_redirect ( '/admin/einsatzgebietepsbearbeiten' );
					}
				}
				
				if ($form->hinzufuegen->isChecked ()) {
					$einsatzgbtHinzufuegen = $form->getValue ( 'attributHinzufuegen' );
					if (! empty ( $einsatzgbtHinzufuegen )) {
						try { // TODO Dennis
							$psmapper->insertEinsatzgebiet ( $einsatzgbtHinzufuegen );
							$this->_redirect ( '/admin/einsatzgebietepsbearbeiten' );
						} catch ( Exception $e ) {
							$_SESSION ['einsatzgbtPsNotInserted'] = 1;
						}
					}
				}
			}
		}
	}
	public function angebotebearbeitenAction() {
		$request = $this->getRequest ();
		$pos = $request->getParam ( 'angebot' );
		if ($pos !== null) {
			$db_mapper = new Application_Model_AngebotskorbMapper ();
			$open_offers = $db_mapper->getAngebotskoerbeStatusNotClosed ();
			foreach ( $open_offers as $open_offer ) {
				if ($open_offer->getId () == $pos) {
					$change_offer = $open_offer;
					// break;
				}
			}
			
			$_SESSION ['otc'] = $change_offer;
			
			// FORMULAR übermitteln und dann auswerten
			$form = new Application_Form_AngebotBearbeiten ();
			$action = '/admin/angebotebearbeiten/angebot/' . $pos;
			$form->setMethod ( 'post' );
			$form->setAction ( $action );
			
			$this->view->form = $form;
			$this->view->infoData = $change_offer;
			
			if ($this->_request->isPost ()) {
				$formData = $this->getRequest ()->getPost ();
				
				if ($form->isValid ( $formData )) {
					$articles = $change_offer->getAngebot ();
					foreach ( $articles as $index => $article ) {
						$newState = $formData ["newState$index"];
						$article->setStatus ( $newState );
					}
					$db_mapper->updateAngebotStatus ( $change_offer );
					$this->_redirect ( '/admin/showangebote' );
				}
			}
		}
	}
	public function showangeboteAction() {
		$db_mapper = new Application_Model_AngebotskorbMapper ();
		$open_offers = $db_mapper->getAngebotskoerbeStatusNotClosed ();
		$this->view->open_offers = $open_offers;
	}
}