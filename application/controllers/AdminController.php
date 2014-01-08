<?php
	class AdminController extends Zend_Controller_Action { 
		
		public function init(){
			
		}
		
		public function indexAction(){
			
		}
		
		public function changewaermetauscherAction(){
			$request = $this->getRequest ();
			$art = $request->getParam ( 'artikel' );
			//TODO Ausnahmen abfangen! ->schlumpfhandling -.-
			if (true) {
				$db_mapper = new Application_Model_WaermetauscherMapper ();
				$data_object = $db_mapper->getWaermetauscherByModel ( $art );
				$this->view->dbdata = $data_object;
				
				$artikel = array($data_object); //TODO Variablen an Form übergeben
				
				$form = new Application_Form_WtBearbeiten();
				$form->produkt->addMultiOptions($artikel);
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