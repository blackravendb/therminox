<?php

class WaermetauscherController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->title = "Produktberater";
        
        $form = new Application_Form_ProduktberaterWt();
        $this->view->produktberater = $form;
        
        if($produktberater->_request->isPost())
        {
        	$formData = $this->_request->getPost();
        	
        	if($produktberater->isValid($formData))
        	{
        		$temp = $produktberater->getValue('Temperatur');
        		$einsatzgbt = $produktberater->getValue('Einsatzgebiet');
        		$anschluss = $produktberater->getValue('Anschluss');
        		$maxHeight = $produktberater->getValue('Hoehe');
        		$maxWidth = $produktberater->getValue('Breite');
        		
        		if($einsatzgbt != null){
        			//TODO
        			//Datenbankabfragen
        		}
        	}
        	else{
        		$produktberater->populate($formData);
        	}
        }
    }

    public function indexAction()
    {
        
    }

    public function geloetetAction()
    {
        // action body
    }

    public function geschraubtAction()
    {
        // action body
    }

    public function rohrbuendelAction()
    {
        // action body
    }


}







