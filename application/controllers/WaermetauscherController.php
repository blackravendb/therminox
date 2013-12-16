<?php

class WaermetauscherController extends Zend_Controller_Action
{

    public function init()
    {
       
    }

    public function indexAction()
    {
     $this->view->title = "Produktberater";
        
        $form = new Application_Form_ProduktberaterWt();
        $form->setMethod('post');
        
        $this->view->produktberater = $form;
        
        if($this->_request->isPost())
        {
        	$formData = $this->_request->getPost();
        	
        	if($this->isValid($formData))
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
        		echo $form;
        	}
        }
    }

    public function geloetetAction()
    {
        // action body
        //view methode für gelötete artikel
    }

    public function geschraubtAction()
    {
        // action body
        // view methode für geschraubte, gesondertes angebotsformular!
    }

    public function rohrbuendelAction()
    {
        // action body
        // view methode für rohrbündel, gesondertes angebotsformular!
    }


}







