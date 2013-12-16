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
        	
        	if($form->isValid($formData))
        	{
        		$temp = $form->getValue('Temperatur');
        		$einsatzgbt = $form->getValue('Einsatzgebiet');
        		$anschluss = $form->getValue('Anschluss');
        		$maxHeight = $form->getValue('Hoehe');
        		$maxWidth = $form->getValue('Breite');
        		
        			//TODO
        			//Datenbankabfragen
        		}
        }
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







