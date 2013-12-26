<?php

class WaermetauscherController extends Zend_Controller_Action
{

    public function init()
    {
       $this->view->showVor = false; //Vorschläge werden noch nicht angezeigt
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
        		$typ = $form->getValue('Typ');
        		$speicherinhalt = $form->getValue('Speicherinhalt');
        		$leergewicht = $form->getValue('Leergewicht');
        		$anschlussKw = $form->getValue('AnschlussKaltwasser');
        		$anschlussWm = $form->getValue('AnschlussWarmwasser');
        		$anschlussLs = $form->getValue('AnschlussLadestutzen');
        		$anschlussZk = $form->getValue('AnschlussZirkulation');
        		$anschlussTm = $form->getValue('AnschlussThermometer');
       
      			$this->view->showVor = true; //Vorschläge werden angezeigt
        		
        			//TODO
        			//Datenbankabfragen
        			//Suchergebnisse anzeigen lassen
        		}
        }
    }

    public function vvxAction()
    {
        // action body
        //view methode f�r vvx artikel
    }

    public function lasAction()
    {
        // action body
        // view methode f�r las artikel
    }

}







