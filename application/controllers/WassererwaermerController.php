<?php

class WassererwaermerController extends Zend_Controller_Action
{
	
 	public function init()
    {
       $this->view->showVor = false; //Vorschläge werden noch nicht angezeigt
    }

    public function indexAction()
    {
     $this->view->title = "ProduktberaterWasserwärmer";
        
        $form = new Application_Form_ProduktberaterWw();
        $form->setMethod('post');
        
        $this->view->produktberaterWw = $form;
        
        if($this->_request->isPost())
        {
        	$formData = $this->_request->getPost();
        	
        	if($form->isValid($formData))
        	{
        		$typ = $form->getValue('Typ');
        		$heizwendel = $form->getValue('Heizwendel');
        		$speicherinhalt = $form->getValue('Speicherinhalt');
        		$leergewicht = $form->getValue('Leergewicht');
        		$anschlussKw = $form->getValue('AnschlussKaltwasser');
        		$anschlussWw = $form->getValue('AnschlussWarmwasser');
        		
      			$this->view->showVor = true; //Vorschläge werden angezeigt
        		
        			//TODO
        			//Datenbankabfragen
        			//Suchergebnisse anzeigen lassen
        		}
        }
    }

    public function vveAction()
    {
        // action body
    }

    public function shiAction()
    {
        // action body
    }

    public function vviAction()
    {
        // action body
    }


}







