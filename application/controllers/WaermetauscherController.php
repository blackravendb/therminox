<?php

class WaermetauscherController extends Zend_Controller_Action
{

    public function init()
    {
       $this->view->showVor = false; //Vorschläge werden noch nicht angezeigt
    }

    public function indexAction()
    {
     $this->view->title = "ProduktberaterWärmetauscher";
        
        $form = new Application_Form_ProduktberaterWt();
        $form->setMethod('post');
        
        $this->view->produktberaterWt = $form;
        
        if($this->_request->isPost())
        {
        	$formData = $this->_request->getPost();
        	
        	if($form->isValid($formData))
        	{
        		$temp = $form->getValue('Temperatur');
        		$einsatzgbt = $form->getValue('Einsatzgebiet');
        		$anschluss = $form->getValue('Anschluss');
        		$maxHeight = $form->getValue('Hoehe');
        		$maxWidth = $form->getValue('Breite');
        		$maxLength = $form->getValue('Laenge');
        		
      			$this->view->showVor = true; //Vorschläge werden angezeigt
        		
        			//TODO
        			//Datenbankabfragen
        			//Suchergebnisse anzeigen lassen
        		}
        }
    }

    public function geloetetAction()
    {
        // action body
        //view methode f�r gel�tete artikel
    }

    public function geschraubtAction()
    {
        // action body
        // view methode f�r geschraubte, gesondertes angebotsformular!
    }

    public function rohrbuendelAction()
    {
        // action body
        // view methode f�r rohrb�ndel, gesondertes angebotsformular!
    }


}







