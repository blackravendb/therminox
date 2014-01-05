<?php
class WaermetauscherController extends Zend_Controller_Action
{

    public function init()
    {	session_start();
    require_once 'Cart/ShoppingCart.php';
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
      			
      			if($maxWidth == null){ //TODO evtl ===
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




