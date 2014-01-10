<?php
	class AdminController extends Zend_Controller_Action { 
		
		public function init(){
			$this->view->showMessage = false;
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
			if (true){
				$db_mapper = new Application_Model_WaermetauscherMapper ();
				$data_object = $db_mapper->getWaermetauscherByModel($art);
				
				$form = new Application_Form_WtBearbeiten();
				$form->setDbdata($data_object);
				$form->startform();
				
				$this->view->wtbearbeiten = $form; 
				
				if($this->_request->isPost()){
					$formData = $this->_request->getPost();
				
					if($form->isValid($formData)){
						$artikelname = $form->getValue('Artikelname');
						$temp = $form->getValue('Temperatur');
						$einsatzgbt = $form->getValue('EinsatzgebietePs');
						$anschluss = $form->getValue('Anschluss');
						$height = $form->getValue('Hoehe');
						$width = $form->getValue('Breite');
						
						$wt = new Application_Model_WaermetauscherMapper();
						$wt_art = $wt->getWaermetauscherByModel($artikelname);
						
						if (!empty($artikelname)) {
							$wt_art->setModel($artikelname);
						}
						if(!empty($temp)){
							$wt_art->setTemperatur($temp);
						}
						
						$wt_art->setWaermetauscherEinsatzgebiet($einsatzgbt);
						
						if(!empty($anschluss)){ //TODO Dennis fragen, wann setter aufgerufen werden soll
							$wt_art->setWaermetauscherAnschluss($anschluss);
						}
						if(!empty($height)){
							$wt_art->setHoehe($maxHeight);
						}
						if(!empty($width)){
							$wt_art->setBreite($maxWidth);
						}
						
						//TODO updateWaermetauscher aufrufen!
						
						$this->view->showMessage = true;
					}
				}
			} else {
				$this->view->message = 'Artikel konnte nicht gefunden werden';
				if (isset ( $_SERVER ['HTTP_REFERER'] )) {
					$this->view->link = $_SERVER ['HTTP_REFERER'];
				} else {
					$this->view->link = '/Waermetauscher';
				}
			}
			
		}
		
		public function changepufferspeicherAction(){
		$request = $this->getRequest();
			$art = $request->getParam('artikel');
			if (true){
				$db_mapper = new Application_Model_PufferspeicherMapper ();
				$data_object = $db_mapper->getPufferspeicherByModel($art);
				
				$form = new Application_Form_PsBearbeiten();
				$form->setDbdata($data_object);
				$form->startform();
				
				$this->view->psbearbeiten = $form; 
				
				if($this->_request->isPost()){
					$formData = $this->_request->getPost();
				
					if($form->isValid($formData)){
						$artikelname = $form->getValue('Artikelname');
						$einsatzgbt = $form->getValue('Einsatzgebiet');
						$speicherinhalt = $form->getValue('Speicherinhalt');
						$betriebsdruck = $form->getValue('Speicherinhalt');
						
						$ps = new Application_Model_PufferspeicherMapper();
						$ps_art = $ps->getPufferspeicherByModel($artikelname);
						
						if (!empty($artikelname)) {
							$ps->setModel($artikelname);
						}
						
						$ps->setPufferspeicherEinsatzgebiet($einsatzgbt);
						
						if(!empty($speicherinhalt)){
							$ps->setSpeicherinhalt($speicherinhalt);
						}
						if(!empty($betriebsdruck)){
							$ps->setBetriebsdruck($betriebsdruck);
						}
						
						//TODO updateWaermetauscher aufrufen!
						
						$this->view->showMessage = true;
					}
				}
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