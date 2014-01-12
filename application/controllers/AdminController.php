<?php
	class AdminController extends Zend_Controller_Action { 
		
		public function init(){
			$this->view->showMessage = false;
			$this->view->showUnterkategorien = false;
			$this->view->showMessageUn = false;
		}
		
		public function indexAction(){
			
		}
		
		public function showwaermetauscherAction(){
				$db_mapper = new Application_Model_WaermetauscherMapper ();
				$data_object = $db_mapper->getWaermetauscher();
				$this->view->dbdata = $data_object;
		}
		
		public function showpufferspeicherAction(){
				$db_mapper = new Application_Model_PufferspeicherMapper ();
				$data_object = $db_mapper->getPufferspeicher();
				$this->view->dbdata = $data_object;
		}
		
		public function changewaermetauscherAction(){
			$request = $this->getRequest();
			$art = $request->getParam('artikel');
				$db_mapper = new Application_Model_WaermetauscherMapper ();
				$data_object = $db_mapper->getWaermetauscherByModel($art);
				
				$form = new Application_Form_WtBearbeiten();
				$form->setDbdata($data_object);
				$form->startform();
				
				$this->view->wtbearbeiten = $form; 
		
					if($this->_request->isPost()){
						$formData = $this->_request->getPost();
					
						if($form->isValid($formData)){
							$form->populate ( $_POST );
							
							if($form->artikelAendern->isChecked()){
							
								$artikelname = $form->getValue('Artikelname');
								$temp = $form->getValue('Temperatur');
								$einsatzgbt = $form->getValue('Einsatzgebiete');
								$anschluss = $form->getValue('Anschluss');
								$height = $form->getValue('Hoehe');
								$width = $form->getValue('Breite');
								
								$data_object->setModel($artikelname);
								$data_object->setTemperatur($temp);
								
								foreach($einsatzgbt as $value){
										$einWT = new Application_Model_WaermetauscherEinsatzgebiet();
										$einWT->setEinsatzgebiet($value);
										
										$data_object->insertWaermetauscherEinsatzgebiet($einWT);
									}
								
								foreach($anschluss as $value){
										$ansWT = new Application_Model_WaermetauscherAnschluss(); 
										$ansWT->setAnschluss($value);
									
										$data_object->insertWaermetauscherAnschluss($ansWT); 
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
						
						echo "Unterkategorien anzeigen!";
						
						$this->view->kategorien = $unterkategorien;
						$this->view->artikel = $data_object;
						$this->view->showUnterkategorien = true;
					}
		}
		
		public function deletewaermetauscherAction(){
			$request = $this->getRequest();
			$art = $request->getParam('artikel');
			$db_mapper = new Application_Model_WaermetauscherMapper();
			$data_object = $db_mapper->getWaermetauscherByModel($art);
			
			try{
			$db_mapper->deleteWaermetauscher($data_object);
			}catch (Exception $e){
				$_SESSION['wtnotdelete'] = 1;
			}
			$this->_redirect('/Admin/showwaermetauscher');
		}
		
		public function changewtunterkategorieAction(){ 
			$request = $this->getRequest();
			$art = $request->getParam('artikel'); //TODO
			$db_mapper = new Application_Model_WaermetauscherMapper ();
			$data_object = $db_mapper->getWaermetauscherByModel($art);
			$unterkategorien = $data_object->getWaermetauscherUnterkategorie();
			$index = $_GET["index"];
			$unterkategorie = $unterkategorien[$index];
			
			$form = new Application_Form_UnterkategorienBearbeiten();
			$form->setDbdata($unterkategorie);
			$form->startform();
				
			$this->view->wtunterkategorienbearbeiten = $form; 
		
				if($this->_request->isPost()){
					$formData = $this->_request->getPost();
				
					if($form->isValid($formData)){
						$platten = $form->getValue('AnzahlPlatten');
						$laenge = $form->getValue('Laenge');
						$leergewicht = $form->getValue('Leergewicht');
						$flaeche = $form->getValue('Flaeche');
						$inhaltPrimaer = $form->getValue('inhaltPrimaer');
						$inhaltSekundaer = $form->getValue('inhaltSekundaer');
						
						$leergewicht = str_replace(",", ".", $leergewicht);
						$flaeche = str_replace(",", ".", $flaeche);
						
						if(!empty($inhaltPrimaer)){
							$inhaltPrimaer = str_replace(",", ".", $inhaltPrimaer);
						}
						if(!empty($inhaltSekundaer)){
							$inhaltSekundaer = str_replace(",", ".", $inhaltSekundaer);
						}
						
						$unterkategorie->setPlatten($platten);
						$unterkategorie->setLaenge($laenge);
						$unterkategorie->setLeergewicht($leergewicht);
						$unterkategorie->setFlaeche($flaeche);
						if(!empty($inhaltPrimaer)){
							$unterkategorie->setInhaltPrimaer($inhaltPrimaer);
						}
						if(!empty($inhaltSekundaer)){
							$unterkategorie->setInhaltSekundaer($inhaltSekundaer);
						}
						
						$db_mapper->updateWaermetauscher($data_object);
						
						$this->view->showMessageUn = true;
			}
		}
	}

		
		public function deletewtunterkategorieAction(){ //TODO
			$request = $this->getRequest();
			$art = $request->getParam('???'); //TODO
			
			
		}
		
		public function changepufferspeicherAction(){
				$request = $this->getRequest();
				$art = $request->getParam('artikel');
				$db_mapper = new Application_Model_PufferspeicherMapper ();
				$data_object = $db_mapper->getPufferspeicherByModel($art);
				
				$form = new Application_Form_PsBearbeiten();
				$form->setDbdata($data_object);
				$form->startform();
				
				$this->view->psbearbeiten = $form; 

					$formData = $this->_request->getPost();
				
					if($form->isValid($formData)){
						$artikelname = $form->getValue('Artikelname');
						$einsatzgbt = $form->getValue('Einsatzgebiete');
						$speicherinhalt = $form->getValue('Speicherinhalt');
						$betriebsdruck = $form->getValue('Speicherinhalt');
						
						$data_object->setModel($artikelname);
						
						foreach($einsatzgbt as $value){
							$einPS = new Application_Model_PufferspeicherEinsatzgebiet();
							$einPS->setEinsatzgebiet($value);
							
							$data_object->insertEinsatzgebiet($einPS); //TODO
						}
						
						
						$data_object->setSpeicherinhalt($speicherinhalt);
						$data_object->setBetriebsdruck($betriebsdruck);
						
						$db_mappert->updatePufferspeicher($data_object);
						
						$this->view->showMessage = true;
				}
			}
		
		public function deletepufferspeicherAction(){ 
			$request = $this->getRequest();
			$art = $request->getParam('artikel');
			$db_mapper = new Application_Model_PufferspeicherMapper();
			$data_object = $db_mapper->getPufferspeicherByModel($art);
			
			try{
			$db_mapper->deletePufferspeicher($data_object);
			}catch(Exception $e){
				$_SESSION['psnotdelete'] = 1;
			}
			$this->_redirect('/Admin/showpufferspeicher');
		}
		
		public function bearbeiten($attrib){//TODO evtl löschen
			
			
		}
		
		public function anschluessebearbeitenAction(){
				$wtmapper = new Application_Model_WaermetauscherMapper();
				$anschluesse = $wtmapper->getAnschlussListe();
				
				$form = new Application_Form_AttributeBearbeiten();
				$form->setDbdata($anschluesse);
				$form->startform();
				
				$this->view->attributeBearbeiten = $form; 
				
				if($this->_request->isPost()){
					$formData = $this->_request->getPost();
				
					if($form->isValid($formData)){ 
						$form->populate($_POST);
						
						if($form->attributLoeschen->isChecked()){
							$anschLoeschen = $form->getValue('AttributLoeschen');
							foreach($anschLoeschen as $value){
								deleteAnschluss($value);
							}
						}
						
						if($form->hinzufuegen->isChecked()){
							$anschHinzufuegen = $form->getValue('attributHinzufuegen');
							insertAnschluss($anschHinzufuegen);
						}
					}
				}
		}
		
		public function einsatzgebietebearbeitenAction(){ //TODO Auf Methode warten
			$wtmapper = new Application_Model_WaermetauscherMapper();
			$einsatzgebiete = $wtmapper->getEinsatzgebietListe();
			
			$form = new Application_Form_AttributeBearbeiten();
			$form->setDbdata($einsatzgebiete);
			$form->startform();
			
			$this->view->attributeBearbeiten = $form;
			
			if($this->_request->isPost()){
				$formData = $this->_request->getPost();
				
				if($form->isValid($formData)){
					
					if($form->attributLoeschen->isChecked()){
						$einsatzgbtLöschen = $form->getValue('AttributLoeschen');
						//TODO Datenbankfunktion Einsatzgebiete löschen
					}
					
					if($form->hinzufuegen->isChecked()){
						$einsatzgbtHinzufuegen = $form->getValue('attributHinzufuegen');
						//TODO Datenbankfunktion Einsatzgebiete einfügen
					}
				}
			}
		}
		
		public function stutzenmaterialbearbeitenAction(){ //TODO Auf Methode warten
			$wtmapper = new Application_Model_WaermetauscherMapper();
			$stutzenmaterial = $wtmapper->getStutzenmaterialListe();
			
			$form = new Application_Form_AttributeBearbeiten();
			$form->setDbdata($stutzenmaterial);
			$form->startform();
			
			$this->view->attributeBearbeiten = $form;
			
			if($this->_request->isPost()){
				$formData = $this->_request->getPost();
				
				if($form->isValid($formData)){
					
					if($form->attributLoeschen->isChecked()){
						$stutzenmaterialLöschen = $form->getValue('AttributLoeschen');
						//TODO Datenbankfunktion Stutzenmaterial löschen
					}
					
					if($form->hinzufuegen->isChecked()){
						$stutzenmaterialHinzufuegen = $form->getValue('attributHinzufuegen');
						//TODO Datenbankfunktion Stutzenmaterial hinzufügen
					}
				}
			}
		}
		
		public function einsatzgebietepsbearbeitenAction(){
			$psmapper= new Application_Model_PufferspeicherMapper();
			$einsatzgebiete = $psmapper->getEinsatzgebietListe();
			
			$form = new Application_Form_AttributeBearbeiten();
			$form->setDbdata($einsatzgebiete);
			$form->startform();
			
			$this->view->attributeBearbeiten = $form;
			
			if($this->_request->isPost()){
				$formData = $this->_request->getPost();
				
				if($form->isValid($formData)){
					
					if($form->attributLoeschen->isChecked()){
						$einsatzgbtLöschen = $form->getValue('AttributLoeschen');
						//TODO Datenbankfunktion Einsatzgebiete löschen
					}
					
					if($form->hinzufuegen->isChecked()){
						$einsatzgbtHinzufuegen = $form->getValue('attributHinzufuegen');
						//TODO Datenbankfunktion Einsatzgebiete hinzufügen
					}
				}
			}
		}
		
		
		
		
	}