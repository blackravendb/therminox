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
    	
     	$minTemp = 155;
     	$maxTemp = 195;
     	$minHeight = 170;
     	$maxHeight = 1100;
     	$minWidth = 70;
     	$maxWidth = 400;
     	$minLength = 20;
     	$maxLength = 500;
     	
        $form = new Application_Form_ProduktberaterWt(array('minTemp' => '155', 'maxTemp' => '195', 
        												'minHeight' => '170', 'maxHeight' => '1100', 
        												'minWidth' => '70', 'maxWidth' => '400', 
        												'minLength' => '20', 'maxLength' => '500'));
        $form->setMethod('post');
        
        $this->view->produktberaterWt = $form;
        
        if($this->_request->isPost())
        {
        	$formData = $this->_request->getPost();
        	
        	if($form->isValid($formData))
        	{
        		$temp = $form->getElement('Temperatur');
        		$einsatzgbt = $form->getElement('Einsatzgebiet');
        		$anschluss1 = $form->getElement('Anschluss1');
        		$anschluss2 = $form->getElement('Anschluss2');
        		$anschluss3 = $form->getElement('Anschluss3');
        		$maxHeight = $form->getElement('Hoehe');
        		$maxWidth = $form->getElement('Breite');
        		$maxLength = $form->getElement('Laenge');
        		
        		/*
        		$tempVal = $form->getElement('tempVal');
        		$heightVal = $form->getElement('heightVal');
        		$widthVal = $form->getElement('widthVal');
        		$lengthVal = $form->getElement('lengthVal');
        		*/
      			if($temp){
      				$temp->setValue($form->getMaxTemp());
      				$temp = $form->getMaxTemp();
      			}
      			
      			if(!$anschluss1->isChecked() && !$anschluss2->isChecked() && !$anschluss3->isChecked()){
      				//$anschluss->setChecked(array('3/8" IG', '1/2" AG', '3/4" AG'));
      				 //$anschluss->addElement(array('checkedValue' => '3/8" IG'));
      				 $anschluss1->setChecked(true);
      				 $anschluss2->setChecked(true);
      				 $anschluss3->setChecked(true);
      			}
      			
      			if($maxHeight){
   					$maxHeight->setValue($form->getMaxHeight());
      				$maxHeight = $form->getMaxHeight();
      			}
      			
      			if($maxWidth == null){
      				$maxWidth->setValue($form->getMaxWidth());
      				$maxWidth = $form->getMaxWidth();
      			}
      			
      			if($maxLength == null){
      				$maxLength->setValue($form->getMaxLength());
      				$maxLength = $form->getMaxLength();
      			}
        			//TODO
        			//Datenbankabfragen
        			//Suchergebnisse anzeigen lassen
        			
      				$this->view->showVor = true; //Vorschläge werden angezeigt
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







