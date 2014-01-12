<?php
class AdminController extends Zend_Controller_Action {
	public function init() {
		$this->view->showMessage = false;
		$this->view->showUnterkategorien = false;
		$this->view->showMessageUn = false;
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
		$data_object = $db_mapper->getWaermetauscherByModel ( $art );
		
		$form = new Application_Form_WtBearbeiten ();
		$form->setDbdata ( $data_object );
		$form->startform ();
		
		$this->view->wtbearbeiten = $form;
		
		if ($this->_request->isPost ()) {
			$formData = $this->_request->getPost ();
			
			if ($form->isValid ( $formData )) {
				$form->populate ( $_POST );
				
				if ($form->artikelAendern->isChecked ()) {
					
<<<<<<< HEAD
					$artikelname = $form->getValue ( 'Artikelname' );
					$temp = $form->getValue ( 'Temperatur' );
					$einsatzgbt = $form->getValue ( 'Einsatzgebiete' );
					$anschluss = $form->getValue ( 'Anschluss' );
					$height = $form->getValue ( 'Hoehe' );
					$width = $form->getValue ( 'Breite' );
					
					$data_object->setModel ( $artikelname );
					$data_object->setTemperatur ( $temp );
					
					foreach ( $einsatzgbt as $value ) {
						$einWT = new Application_Model_WaermetauscherEinsatzgebiet ();
						$einWT->setEinsatzgebiet ( $value );
=======
						if($form->isValid($formData)){
							$form->populate ( $_POST );
							
							if($form->artikelAendern->isChecked()){
							
								$artikelname = $form->getValue('Artikelname');
								$temp = $form->getValue('Temperatur');
								$einsatzgbt = $form->getValue('Einsatzgebiete');
								$anschluss = $form->getValue('Anschluss');
								$height = $form->getValue('Hoehe');
								$width = $form->getValue('Breite');
								
								$egAlt = $data_object->getWaermetauscherEinsatzgebiet();
								$anAlt = $data_object->getWaermetauscherAnschluss();
								
								$data_object->setModel($artikelname);
								$data_object->setTemperatur($temp);
								
								//EinsatzgebietObjekte erstellen und einfügen //TODO Dennis
								if(!empty($einsatzgbt)){
									foreach($einsatzgbt as $value){
										$einsatzgbtObj = new Application_Model_WaermetauscherEinsatzgebiet();
										$einsatzgbtObj->setEinsatzgebiet($value);
										
										$data_object->insertWaermetauscherEinsatzgebiet($einsatzgbtObj);
									}
								}
								if(!empty($egAlt)){
									foreach($egAlt as $value){
										$data_object->deleteWaermetauscherEinsatzgebiet($value);
									}
								}
								
								//AnschlussObjekte erstellen und einfügen //TODO Dennis
								if(!empty($anschluss)){
									foreach($anschluss as $value){
										$anschObj = new Application_Model_WaermetauscherAnschluss();
										$anschObj->setAnschluss($value);
										
										$data_object->insertWaermetauscherAnschluss($anschObj);
										}
								}
								if(!empty($anAlt) && !empty($anschluss)){//alte Anschluesse löschen wenn vorhanden
									foreach($anAlt as $value){ 
										$data_object->deleteWaermetauscherAnschluss($value);
									}
								}
								
								$data_object->setHoehe($height);
								$data_object->setBreite($width);
								
								$db_mapper->updateWaermetauscher($data_object);
								
								$this->view->showMessage = true;
								}
							}
				}
					if($form->unterkategorien->isChecked()){ //TODO
						$unterkategorien = $data_object->getWaermetauscherUnterkategorie();
>>>>>>> fd9a5dc9e7c7af044a9bd6f3be189c57405dec6f
						
						$data_object->insertWaermetauscherEinsatzgebiet ( $einWT );
					}
					
					foreach ( $anschluss as $value ) {
						$ansWT = new Application_Model_WaermetauscherAnschluss ();
						$ansWT->setAnschluss ( $value );
						
						$data_object->insertWaermetauscherAnschluss ( $ansWT );
					}
					
					$data_object->setHoehe ( $height );
					$data_object->setBreite ( $width );
					
					$db_mapper->updateWaermetauscher ( $data_object );
					
					$this->view->showMessage = true;
				}
			}
		}
		if ($form->unterkategorien->isChecked ()) { // TODO
			$unterkategorien = $data_object->getWaermetauscherUnterkategorie ();
			
			echo "Unterkategorien anzeigen!";
			
			$this->view->kategorien = $unterkategorien;
			$this->view->artikel = $data_object;
			$this->view->showUnterkategorien = true;
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
		$art = $request->getParam ( 'artikel' ); // TODO
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
				
<<<<<<< HEAD
				$unterkategorie->setPlatten ( $platten );
				$unterkategorie->setLaenge ( $laenge );
				$unterkategorie->setLeergewicht ( $leergewicht );
				$unterkategorie->setFlaeche ( $flaeche );
				if (! empty ( $inhaltPrimaer )) {
					$unterkategorie->setInhaltPrimaer ( $inhaltPrimaer );
				}
				if (! empty ( $inhaltSekundaer )) {
					$unterkategorie->setInhaltSekundaer ( $inhaltSekundaer );
=======
					if($form->isValid($formData)){
						$artikelname = $form->getValue('Artikelname');
						$einsatzgbt = $form->getValue('Einsatzgebiete');
						$speicherinhalt = $form->getValue('Speicherinhalt');
						$betriebsdruck = $form->getValue('Speicherinhalt');
						
						$data_object->setModel($artikelname);
						
						//TODO wie bei WT
						foreach($einsatzgbt as $value){
							$einPS = new Application_Model_PufferspeicherEinsatzgebiet();
							$einPS->setEinsatzgebiet($value);
							
							$data_object->insertEinsatzgebiet($einPS); //TODO
						}
						
						
						$data_object->setSpeicherinhalt($speicherinhalt);
						$data_object->setBetriebsdruck($betriebsdruck);
						
						$db_mappert->updatePufferspeicher($data_object);
						
						$this->view->showMessage = true;
>>>>>>> fd9a5dc9e7c7af044a9bd6f3be189c57405dec6f
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
		
		$formData = $this->_request->getPost ();
		
		if ($form->isValid ( $formData )) {
			$artikelname = $form->getValue ( 'Artikelname' );
			$einsatzgbt = $form->getValue ( 'Einsatzgebiete' );
			$speicherinhalt = $form->getValue ( 'Speicherinhalt' );
			$betriebsdruck = $form->getValue ( 'Speicherinhalt' );
			
			$data_object->setModel ( $artikelname );
			
			foreach ( $einsatzgbt as $value ) {
				$einPS = new Application_Model_PufferspeicherEinsatzgebiet ();
				$einPS->setEinsatzgebiet ( $value );
				
				$data_object->insertEinsatzgebiet ( $einPS ); // TODO
			}
			
			$data_object->setSpeicherinhalt ( $speicherinhalt );
			$data_object->setBetriebsdruck ( $betriebsdruck );
			
			$db_mappert->updatePufferspeicher ( $data_object );
			
			$this->view->showMessage = true;
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
					foreach ( $anschLoeschen as $value ) { // TODO Dennis
						try {
							$wtmapper->deleteAnschluss ( $value );
							$this->_redirect ( '/Admin/anschluessebearbeiten' );
						} catch ( Exception $e ) {
							$_SESSION ['anschlNotDelete'] = 1;
						}
					}
				}
				
				if ($form->hinzufuegen->isChecked ()) {
					$anschHinzufuegen = $form->getValue ( 'attributHinzufuegen' ); // TODO Dennis
					try {
						$wtmapper->insertAnschluss ( $anschHinzufuegen );
						$this->_redirect ( '/Admin/anschluessebearbeiten' );
					} catch ( Exception $e ) {
						$_SESSION ['anschlNotInsert'] = 1;
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
				
<<<<<<< HEAD
				if ($form->attributLoeschen->isChecked ()) {
					$einsatzgbtLöschen = $form->getValue ( 'AttributLoeschen' );
					foreach ( $einsatzgbtLöschen as $value ) { // TODO Dennis
						try {
							$wtmapper->deleteEinsatzgebiet ( $value );
							$this->_redirect ( '/Admin/einsatzgebietebearbeiten' );
						} catch ( Exception $e ) {
							$_SESSION ['einsatzgbtNotInsert'] = 1;
=======
					if($form->isValid($formData)){ 
						$form->populate($_POST);
						
						if($form->attributLoeschen->isChecked()){
							$anschLoeschen = $form->getValue('AttributLoeschen');
							if(!empty($anschLoeschen)){
								foreach($anschLoeschen as $value){ //TODO Dennis
									try{
										$wtmapper->deleteAnschluss($value);
										$this->_redirect('/Admin/anschluessebearbeiten');
									}catch(Exception $e){
										$_SESSION['anschlNotDelete'] = 1;
									}
								}
							}
						}
						
						if($form->hinzufuegen->isChecked()){
							$anschHinzufuegen = $form->getValue('attributHinzufuegen');//TODO Dennis
							if(!empty($anschHinzufuegen)){
									try{
										$wtmapper->insertAnschluss($anschHinzufuegen);
										$this->_redirect('/Admin/anschluessebearbeiten');
									}catch(Exception $e){
										$_SESSION['anschlNotInsert'] = 1;
									}
							}
>>>>>>> fd9a5dc9e7c7af044a9bd6f3be189c57405dec6f
						}
					}
				}
				if ($form->hinzufuegen->isChecked ()) {
					$einsatzgbtHinzufuegen = $form->getValue ( 'attributHinzufuegen' );
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
				
<<<<<<< HEAD
				if ($form->attributLoeschen->isChecked ()) {
					$stutzenmaterialLoeschen = $form->getValue ( 'AttributLoeschen' );
					foreach ( $stutzenmaterialLoeschen as $value ) { // TODO Dennis
						try {
							$wtmapper->deleteStutzenmaterial ( $value );
							$this->_redirect ( '/Admin/stutzenmaterialbearbeiten' );
						} catch ( Exception $e ) {
							$_SESSION ['stutzenmaterialtNotDeleted'] = 1;
						}
					}
				}
				
				if ($form->hinzufuegen->isChecked ()) {
					$stutzenmaterialHinzufuegen = $form->getValue ( 'attributHinzufuegen' );
					try { // TODO Dennis
						$wtmapper->insertStutzenmaterial ( $stutzenmaterialHinzufuegen );
						$this->_redirect ( '/Admin/stutzenmaterialbearbeiten' );
					} catch ( Exception $e ) {
						$_SESSION ['stutzenmaterialNotInserted'] = 1;
=======
				if($form->isValid($formData)){
					$form->populate($_POST);
					
					if($form->attributLoeschen->isChecked()){
						$einsatzgbtLoeschen = $form->getValue('AttributLoeschen');
						if(!empty($einsatzgbtLoeschen)){
							foreach($einsatzgbtLoeschen as $value){//TODO Dennis
								try{
									$wtmapper->deleteEinsatzgebiet($value);
									$this->_redirect('/Admin/einsatzgebietebearbeiten');
								}catch (Exception $e){
									$_SESSION['einsatzgbtNotInsert'] = 1;
							}
						}
					}
					}
					if($form->hinzufuegen->isChecked()){
						$einsatzgbtHinzufuegen = $form->getValue('attributHinzufuegen');
						if(!empty($einsatzgbtHinzufuegen)){
							try{
								$wtmapper->insertEinsatzgebiet($einsatzgbtHinzufuegen);
								$this->_redirect('/Admin/einsatzgebietebearbeiten');
							}catch(Exception $e){
								$_SESSION['einsatzgbtNotDelete'] = 1;
							}
						}
>>>>>>> fd9a5dc9e7c7af044a9bd6f3be189c57405dec6f
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
				
<<<<<<< HEAD
				if ($form->attributLoeschen->isChecked ()) {
					$einsatzgbtLöschen = $form->getValue ( 'AttributLoeschen' );
					foreach ( $einsatzgbtLöschen as $value ) {
						try {
							$psmapper->deleteEinsatzgebiet ( $value );
							$this->_redirect ( '/Admin/einsatzgebietepsbearbeiten' );
						} catch ( Exception $e ) {
							$_SESSION ['einsatzgbtPsNotDeleted'] = 1;
						}
					}
				}
				
				if ($form->hinzufuegen->isChecked ()) {
					$einsatzgbtHinzufuegen = $form->getValue ( 'attributHinzufuegen' );
					try {
						$psmapper->insertEinsatzgebiet ( $einsatzgbtHinzufuegen );
						$this->_redirect ( '/Admin/einsatzgebietepsbearbeiten' );
					} catch ( Exception $e ) {
						$_SESSION ['einsatzgbtPsNotInserted'] = 1;
=======
				if($form->isValid($formData)){
					$form->populate($_POST);
					
					if($form->attributLoeschen->isChecked()){
						$stutzenmaterialLoeschen = $form->getValue('AttributLoeschen');
						if(!empty($stutzenmaterialLoeschen)){
							foreach($stutzenmaterialLoeschen as $value){//TODO Dennis
								try{
									$wtmapper->deleteStutzenmaterial($value);
									$this->_redirect('/Admin/stutzenmaterialbearbeiten');
								}catch (Exception $e){
									$_SESSION['stutzenmaterialNotDeleted'] = 1;
								}
							}
						}
					}
					
					if($form->hinzufuegen->isChecked()){
						$stutzenmaterialHinzufuegen = $form->getValue('attributHinzufuegen');
						if(!empty($stutzenmaterialHinzufuegen)){
							try{//TODO Dennis
								$wtmapper->insertStutzenmaterial($stutzenmaterialHinzufuegen);
								$this->_redirect('/Admin/stutzenmaterialbearbeiten');
							}catch(Exception $e){
								$_SESSION['stutzenmaterialNotInserted'] = 1;
							}
						}
>>>>>>> fd9a5dc9e7c7af044a9bd6f3be189c57405dec6f
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
			$action = '/Admin/angebotebearbeiten/angebot/' . $pos;
			$form->setMethod ( 'post' );
			$form->setAction ( $action );
			
			if ($this->_request->isPost ()) {
				$formData = $this->getRequest ()->getPost ();
				
<<<<<<< HEAD
				if ($form->isValid ( $formData )) {
					$articles = $change_offer->getAngebot();
					foreach ($articles as $index => $article){
						$newState = $formData["newState$index"];
						$article->setStatus($newState);
=======
				if($form->isValid($formData)){
					$form->populate($_POST);
					
					if($form->attributLoeschen->isChecked()){
						$einsatzgbtLöschen = $form->getValue('AttributLoeschen');
						if(!empty($einsatzgbtLöschen)){
							foreach($einsatzgbtLöschen as $value){
								try{ //TODO Dennis
								$psmapper->deleteEinsatzgebiet($value);
								$this->_redirect('/Admin/einsatzgebietepsbearbeiten');
							}catch(Exception $e){
								$_SESSION['einsatzgbtPsNotDeleted'] = 1;
							}
							}
						}
>>>>>>> fd9a5dc9e7c7af044a9bd6f3be189c57405dec6f
					}
					
<<<<<<< HEAD
					$db_mapper->updateAngebotStatus($change_offer);
					$this->_redirect('/Admin/showangebote');
					
=======
					if($form->hinzufuegen->isChecked()){
						$einsatzgbtHinzufuegen = $form->getValue('attributHinzufuegen');
						if(!empty($einsatzgbtHinzufuegen)){
							try{//TODO Dennis
								$psmapper->insertEinsatzgebiet($einsatzgbtHinzufuegen);
								$this->_redirect('/Admin/einsatzgebietepsbearbeiten');
							}catch (Exception $e){
								$_SESSION['einsatzgbtPsNotInserted'] = 1;
							}
						}
					}
>>>>>>> fd9a5dc9e7c7af044a9bd6f3be189c57405dec6f
				}
			}
			$this->view->form = $form;
			$this->view->infoData = $change_offer;
		}
	}
	public function showangeboteAction() {
		$db_mapper = new Application_Model_AngebotskorbMapper ();
		$open_offers = $db_mapper->getAngebotskoerbeStatusNotClosed ();
		$this->view->open_offers = $open_offers;
	}
}
