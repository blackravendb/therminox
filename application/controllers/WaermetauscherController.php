<?php
class WaermetauscherController extends Zend_Controller_Action
{

    public function init()
    {	session_start();
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
		// action body
		// view methode für gelötete artikel
    }

    public function geschraubtAction()
    {
		// action body
		// view methode für geschraubte, gesondertes angebotsformular!
    }

    public function rohrbuendelAction()
    {
		// action body
		// view methode für rohrb�ndel, gesondertes angebotsformular!
    }

    public function bearbeitenAction()
    {
		// action body
    }

    public function hinzufuegenAction()
    {
        // action body
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




