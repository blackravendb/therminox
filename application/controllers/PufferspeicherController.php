<?php

class PufferspeicherController extends Zend_Controller_Action
{

    public function init()
    {
       $this->view->showVor = false; //Vorschläge werden noch nicht angezeigt
       $this->view->keineVorschläge = false;
    }

    public function indexAction()
    {
     $this->view->title = "ProduktberaterPufferspeicher";
        
     $form = new Application_Form_ProduktberaterPs();
		
        $form->setMethod('post');
        
        $this->view->produktberaterPs = $form;
        
        if($this->_request->isPost())
        {
        	$formData = $this->_request->getPost();
        	
        	if($form->isValid($formData))
        	{
        		$typ = $form->getValue('VVX/LAS');
        		$einsatzgbt = $form->getValue('Einsatzgebiet');
        		$speicherinhalt = $form->getValue('Speicherinhalt');
        		$leergewicht = $form->getValue('Leergewicht');
        		$betriebsdruck = $form->getValue('Betriebsdruck');
        		$temperaturMax = $form->getValue('TemperaturMax');
        		
        		
        		/*
        		$anschlussKw = $form->getValue('AnschlussKaltwasser');
        		$anschlussWm = $form->getValue('AnschlussWarmwasser');
        		$anschlussLs = $form->getValue('AnschlussLadestutzen');
        		$anschlussZk = $form->getValue('AnschlussZk');
        		$anschlussTm = $form->getValue('AnschlussThermometer');
        		*/
        		
        		$psmapper = new Application_Model_PufferspeicherMapper();
        		
        		if(!(strcmp($typ, 'Bitte wählen') == 0)){
        			$psmapper->setTyp($typ);
        		}
        		
        		if(! (strcmp($einsatzgbt, 'Bitte wählen') == 0)){
        			$psmapper->setEinsatzgebiet($einsatzgbt);
        		}
        		
        		if(!empty($speicherinhalt)){
        			$psmapper->setSpeicherinhalt($speicherinhalt);
        		}
        		
        		if(!empty($leergewicht)){
        			$psmapper->setLeergewicht($leergewicht);
        		}
        		
        		if(!empty($betriebsdruck)){
        			$psmapper->setBetriebsdruck($betriebsdruck);
        		}
        		
        		if(!empty($temperaturMax)){
        			$psmapper->setTemperaturMax($temperaturMax);
        		}
        		
        		$produkte = $psmapper->getPufferspeicher();
        		
        		if(!empty($produkte)){
        			$this->view->vorschläge = $produkte;
        		}else{
        			$this->view->keineVorschläge = true;
        		}
        		
        		$this->view->showVor = true; //Vorschläge werden angezeigt
        		
        		/*
        		if(!empty($anschlussKw)){
        			$psmapper->setAnschluss
        		}
        		
        		if($anschlussWm == null){
        			$anschlussWm->setValue($form->getMaxWarm());
        			$anschlussWm = $form->getMaxWarm();
        		}
        		
        		if($anschlussLs == null){
        			$anschlussLs->setValue($form->getMaxLoad());
        			$anschlussLs = $form->getMaxLoad();
        		}
        		
        		if(!$anschlussZk1->isChecked() && !$anschlussZk2->isChecked() && !$anschlussZk3->isChecked() && !$anschlussZk4->isChecked() && !$anschlussZk5->isChecked() && !$anschlussZk6->isChecked()){
        			$anschlussZk1->setChecked(true);
        			$anschlussZk2->setChecked(true);
        			$anschlussZk3->setChecked(true);
        			$anschlussZk4->setChecked(true);
        			$anschlussZk5->setChecked(true);
        			$anschlussZk6->setChecked(true);
        		}
        		
        		if($anschlussTm == null){
        			$anschlussTm->setValue($form->getMaxThermo());
        			$anschlussTm = $form->getMaxThermo();
        		}
        		*/
        		
        		}
        }
    }

	public function vvxAction() {
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
	
	public function lasAction() {
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		if (null != $art) {
			// Artikeldaten aus db auslesen und aufbereiten
			// Statement: SELECT * FROM Pufferspeicher WHERE Kategorie = 'LAS' AND ID like ?, $art;
			$entries = array ();
			$art_name = "Testartikel"; // $entries['Artikelname'];
			$art_dim = 503; // $entries['Fassungsvermögen'];
			$art_conn_zirk = 40; // $entries['Anschluss_Zirkulation'];
			$art_conn_cold = 30; // $entries['Anschluss_Kaltwasser'];
			$art_conn_warm = 30; // $entries['Anschluss_Warmwasser'];
			$art_conn_load = 30; // $entries['Anschluss_Ladestutzen'];
			$art_conn_sens = 30; // $entries['Anschluss_Thermometer'];
			$art_height = 1230; // $entries['Maximale Höhe'];
			$art_width = 123; // $entries['Maximale Breite'];
			
			$container = array (
					$art,
					$art_name,
					$art_dim,
					$art_height,
					$art_width,
					$art_conn_warm,
					$art_conn_cold,
					$art_conn_zirk,
					$art_conn_load,
					$art_conn_sens 
			);
			
			$this->view->art_display = $container;
		} else {
			$this->view->message = 'Artikel konnte nicht gefunden werden';
			if (isset ( $_SERVER ['HTTP_REFERER'] )) {
				$this->view->link = $_SERVER ['HTTP_REFERER'];
			} else {
				$this->view->link = '/Waermetauscher';
			}
		}
	}
	
	public function hinzufuegen() {
		$form = new Application_Form_PsErstellen();
		
		$this->view->form = $form;
	}
}
