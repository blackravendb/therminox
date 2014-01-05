<?php
class WassererwaermerController extends Zend_Controller_Action {

	public function init()
    {
       $this->view->showVor = false; //Vorschläge werden noch nicht angezeigt
    }

    public function indexAction()
    {
     $this->view->title = "ProduktberaterWasserwärmer";

     	$minMem = 150;
     	$maxMem = 2000;
     	$minWeight = 40;
     	$maxWeight = 300;
     
        $form = new Application_Form_ProduktberaterWw(array('minMem' => '150', 'maxMem' => '2000', 
        													'minWeight' => '40', 'maxWeight' => '300'));
        
        $form->setMethod('post');
        
        $this->view->produktberaterWw = $form;
        
        if($this->_request->isPost())
        {
        	$formData = $this->_request->getPost();
        	
        	if($form->isValid($formData))
        	{
        		$typ1 = $form->getElement('Typ1');
        		$typ2 = $form->getElement('Typ2');
        		$typ3 = $form->getElement('Typ3');
        		$heizwendel1 = $form->getElement('Heizwendel1');
        		$heizwendel2 = $form->getElement('Heizwendel2');
        		//$heizwendel = $form->getElement('Heizwendel');
        		$speicherinhalt = $form->getElement('Speicherinhalt');
        		$leergewicht = $form->getElement('Leergewicht');
        		$anschlussKw1 = $form->getElement('AnschlussKw1');
        		$anschlussKw2 = $form->getElement('AnschlussKw2');
        		$anschlussKw3 = $form->getElement('AnschlussKw3');
        		$anschlussKw4 = $form->getElement('AnschlussKw4');
        		$anschlussKw5 = $form->getElement('AnschlussKw5');
        		$anschlussKw6 = $form->getElement('AnschlussKw6');
        		$anschlussWw1 = $form->getElement('AnschlussWw1');
        		$anschlussWw2 = $form->getElement('AnschlussWw2');
        		$anschlussWw3 = $form->getElement('AnschlussWw3');
        		$anschlussWw4 = $form->getElement('AnschlussWw4');
        		$anschlussWw5 = $form->getElement('AnschlussWw5');
        		$anschlussWw6 = $form->getElement('AnschlussWw6');
        		//$anschlussKw = $form->getElement('AnschlussKaltwasser');
        		//$anschlussWw = $form->getElement('AnschlussWarmwasser');
        		
        		if(!($typ1->isChecked() && (!($typ2->isChecked())) && (!($typ3->ischecked())))){
        			$typ1->setChecked(true);
        			$typ2->setChecked(true);
        			$typ3->setChecked(true);
        		}
        		
        		if(!($heizwendel1->isChecked()) && (!($heizwendel2->isChecked()))){
        			$heizwendel1->setChecked(true);
        			$heizwendel2->setChecked(true);
        		}
        		
        		if($speicherinhalt == null){
        			$speicherinhalt->setValue($form->getMaxMem());
        			$speicherinhalt = $form->getMaxMem();
        		}
        		
        		if($leergewicht == null){
        			$leergewicht->setValue($form->getMaxWeight());
        			$leergewicht = $form->getMaxWeight();
        		}
        		
        		if(!$anschlussKw1->isChecked() && !$anschlussKw2->isChecked() && !$anschlussKw3->isChecked() 
        			&& !$anschlussKw4->isChecked() && !$anschlussKw5->isChecked() && !$anschlussKw6->isChecked()){
        			
        			$anschlussKw1->setChecked(true);
        			$anschlussKw2->setChecked(true);
        			$anschlussKw3->setChecked(true);
        			$anschlussKw4->setChecked(true);
        			$anschlussKw5->setChecked(true);
        			$anschlussKw6->setChecked(true);
        		}
        		
        		if(!$anschlussWw1->isChecked() && !$anschlussWw2->isChecked() && !$anschlussWw3->isChecked() && 
        			!$anschlussWw4->isChecked() && !$anschlussWw5->isChecked() && !$anschlussWw7->isChecked()){
        			
        			$anschlussWw1->setChecked(true);
        			$anschlussWw2->setChecked(true);
        			$anschlussWw3->setChecked(true);
        			$anschlussWw4->setChecked(true);
        			$anschlussWw5->setChecked(true);
        			$anschlussWw6->setChecked(true);
        		}
        		
        			//TODO
        			//Datenbankabfragen
        			//Suchergebnisse anzeigen lassen
        			$this->view->showVor = true; //Vorschläge werden angezeigt
        		}
        }
    }
    
	public function vveAction() {
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		if (null != $art) {
			// Artikeldaten aus db auslesen und aufbereiten
			// Statement: SELECT * FROM Wassererwaermer WHERE Kategorie = 'VVE' AND ID like ?, $art;
			$entries = array ();
			$art_name = "Testartikel"; // $entries['Artikelname'];
			$art_sys = 1; // $entries['Kreislauf'];
			$art_dim = 503; // $entries['Fassungsvermögen'];
			$art_weight = 234; // $entries['Gewicht'];
			$art_conn_zirk = 4; // $entries['Anschluss_Zirkulation'];
			$art_conn_cold = 3; // $entries['Anschluss_Kaltwasser'];
			$art_conn_warm = 3; // $entries['Anschluss_Warmwasser'];
			$art_height = 1230; // $entries['Maximale Höhe'];
			$art_width = 123; // $entries['Maximale Breite'];
			
			$container = array (
					$art,
					$art_name,
					$art_sys,
					$art_dim,
					$art_weight,
					$art_height,
					$art_width,
					$art_conn_warm,
					$art_conn_cold,
					$art_conn_zirk 
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
	public function shiAction() {
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		if (null != $art) {
			// Artikeldaten aus db auslesen und aufbereiten
			// Statement: SELECT * FROM Wassererwaermer WHERE Kategorie = 'SHI' AND ID like ?, $art;
			$entries = array ();
			$art_name = "Testartikel"; // $entries['Artikelname'];
			$art_sys = 1; // $entries['Kreislauf'];
			$art_dim = 503; // $entries['Fassungsvermögen'];
			$art_weight = 234; // $entries['Gewicht'];
			$art_conn_zirk = 4; // $entries['Anschluss_Zirkulation'];
			$art_conn_cold = 3; // $entries['Anschluss_Kaltwasser'];
			$art_conn_warm = 3; // $entries['Anschluss_Warmwasser'];
			$art_height = 1230; // $entries['Maximale Höhe'];
			$art_width = 123; // $entries['Maximale Breite'];
			
			$container = array (
					$art,
					$art_name,
					$art_sys,
					$art_dim,
					$art_weight,
					$art_height,
					$art_width,
					$art_conn_warm,
					$art_conn_cold,
					$art_conn_zirk 
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
	public function vviAction() {
		$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		if (null != $art) {
			// Artikeldaten aus db auslesen und aufbereiten
			// Statement: SELECT * FROM Wassererwaermer WHERE Kategorie = 'VVI' AND ID like ?, $art;
			$entries = array ();
			$art_name = "Testartikel"; // $entries['Artikelname'];
			$art_sys = 1; // $entries['Kreislauf'];
			$art_dim = 503; // $entries['Fassungsvermögen'];
			$art_weight = 234; // $entries['Gewicht'];
			$art_conn_zirk = 4; // $entries['Anschluss_Zirkulation'];
			$art_conn_cold = 3; // $entries['Anschluss_Kaltwasser'];
			$art_conn_warm = 3; // $entries['Anschluss_Warmwasser'];
			$art_height = 1230; // $entries['Maximale Höhe'];
			$art_width = 123; // $entries['Maximale Breite'];
			
			$container = array (
					$art,
					$art_name,
					$art_sys,
					$art_dim,
					$art_weight,
					$art_height,
					$art_width,
					$art_conn_warm,
					$art_conn_cold,
					$art_conn_zirk 
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
		$form = new Application_Form_WwErstellen();
		
		$this->view->form = $form;
	}
}







