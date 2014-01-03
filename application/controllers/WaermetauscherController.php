<?php
class WaermetauscherController extends Zend_Controller_Action
{

    public function init()
    {	session_start();
    require_once 'Cart/ShoppingCart.php';
    }

    public function indexAction()
    {
		$this->view->title = "Produktberater";
		
		$form = new Application_Form_ProduktberaterWt ();
		$form->setMethod ( 'post' );
		
		$this->view->produktberater = $form;
		
		if ($this->_request->isPost ()) {
			$formData = $this->_request->getPost ();
			
			if ($form->isValid ( $formData )) {
				$temp = $form->getValue ( 'Temperatur' );
				$einsatzgbt = $form->getValue ( 'Einsatzgebiet' );
				$anschluss = $form->getValue ( 'Anschluss' );
				$maxHeight = $form->getValue ( 'Hoehe' );
				$maxWidth = $form->getValue ( 'Breite' );
				
				// TODO
				// Datenbankabfragen
			
			}
		}	
    }

    public function geloetetAction()
    {
    	$request = $this->getRequest ();
		$art = $request->getParam ( 'artikel' );
		if (null != $art) {
			//Artikeldaten aus db auslesen und aufbereiten
			//Statement: SELECT * FROM Waermetauscher WHERE ID like ?, $art;
			$entries = array();
			$art_name = "Testartikel";//$entries['Artikelname'];
			$art_temp = 1200; //$entries['Temperatur'];
			$art_loc  = "Draussen";//$entries['Einsatzgebiet'];
			// Anschlüsse fehlen noch
			$art_height = 1230; //$entries['Maximale Höhe'];
			$art_width  = 123; // $entries['Maximale Breite'];
			
			$container = array($art_name,$art_loc,$art_temp,$art_height,$art_width,$art);
			
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

    public function geschraubtAction()
    {
		//befindet sich alles im view da statische seite 
    }

    public function rohrbuendelAction()
    {
    	//befindet sich alles im view da statische seite
    }

    public function bearbeitenAction()
    {
		// action body
    }

    public function hinzufuegenAction()
    {
        $form = new Application_Form_WtErstellen();
        
        $this->view->form = $form;
    }

    public function entfernenAction()
    {	/*
        Artikeldaten aus Registry/Session laden
        $artID = $_SESSION['artikel'];
        $artID = $artID['ID'];
        if(buttonpushed){
        Query: 
        DELETE FROM artikel WHERE artikelID IN(SELECT artikelID	FROM artikel
		WHERE artikelID = '$artID' );
		}
		
		$this->view->artikel = $_SESSION['artikel'];
		
		*/
    	
    }


}




