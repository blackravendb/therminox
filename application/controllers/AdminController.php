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
						$einsatzgbt = $form->getValue('Einsatzgebiet');
						$anschluss = $form->getValue('Anschluss');
						$maxHeight = $form->getValue('Hoehe');
						$maxWidth = $form->getValue('Breite');
						
						$wt = new Application_Model_WaermetauscherMapper();
						$wt_art = $wt->getWaermetauscherByModel($artikelname);
						
						$wt_art->setModel($artikelname);
						$wt_art->setTemperatur($temp);
						$wt_art->setWaermetauscherEinsatzgebiet($einsatzgbt);
						$wt_art->setWaermetauscherAnschluss($anschluss);
						$wt_art->setHoehe($maxHeight);
						$wt_art->setBreite($maxWidth);
						
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
					$this->view->link = '/Waermetauscher';
				}
			}
		}
		
		
		
		
		
	}