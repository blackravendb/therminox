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
        
		$minMem = 150;
		$maxMem = 3000;
		$minWeight = 50;
		$maxWeight = 400;
		$minCold = 1070;
		$maxCold = 2800;
		$minWarm = 640;
		$maxWarm = 1865;
		$minLoad = 500;
		$maxLoad = 2675;
		$minThermo = 290;
		$maxThermo = 1565;     
     
        $form = new Application_Form_ProduktberaterPs(array('minMem' => '150', 'maxMem' => '3000', 'minWeight' => '50', 'maxWeigth' => '400',
        													 'minCold' => '1070', 'maxCold' => '2800', 'minWarm' => '640', 'maxWarm' => '1865', 
        													 'minLoad' => '500', 'maxLoad' => '2675', 'minThermo' => '290', 'maxThermo' => '1565'));
        $form->setMethod('post');
        
        $this->view->produktberaterPs = $form;
        
        if($this->_request->isPost())
        {
        	$formData = $this->_request->getPost();
        	
        	if($form->isValid($formData))
        	{
        		$typ1 = $form->getElement('Typ1');
        		$typ2 = $form->getElement('Typ2');
        		$speicherinhalt = $form->getElement('Speicherinhalt');
        		$leergewicht = $form->getElement('Leergewicht');
        		$anschlussKw = $form->getElement('AnschlussKaltwasser');
        		$anschlussWm = $form->getElement('AnschlussWarmwasser');
        		$anschlussLs = $form->getElement('AnschlussLadestutzen');
        		$anschlussZk1 = $form->getElement('AnschlussZk1');
        		$anschlussZk2 = $form->getElement('AnschlussZk2');
        		$anschlussZk3 = $form->getElement('AnschlussZk3');
        		$anschlussZk4 = $form->getElement('AnschlussZk4');
        		$anschlussZk5 = $form->getElement('AnschlussZk5');
        		$anschlussZk6 = $form->getElement('AnschlussZk6');
        		$anschlussTm = $form->getElement('AnschlussThermometer');
        		
        		if($typ == null){
        			$typ->setValue(array('VVX', 'LAS'));
        		}
        		
        		if($speicherinhalt == null){
        			$speicherinhalt->setValue($form->getMaxMem());
        			$speicherinhalt = $form->getMaxMem();
        		}
        		
        		if($leergewicht == null){
        			$leergewicht->setValue($form->getMaxWeight());
        			$leergewicht = $form->getMaxWeight();
        		}
        		
        		if($anschlussKw == null){
        			$anschlussKw->setValue($form->getMaxCold());
        			$anschlussKw = $form->getMaxCold();
        		}
        		
        		if($anschlussWm == null){
        			$anschlussWm->setValue($form->getMaxWarm());
        			$anschlussWm = $form->getMaxWarm();
        		}
        		
        		if($anschlussLs == null){
        			$anschlussLs->setValue($form->getMaxLoad());
        			$anschlussLs = $form->getMaxLoad();
        		}
        		
        		if(!$anschlussZk1->isChecked() && !$anschlussZk2->isChecked() && !$anschlussZk3->isChecked() && !$anschlussZk4->isChecked() && !$anschlussZk5->isChecked() && !$anschlussZk6->isChecked()){
        			$anschlussZk1->setChecked(true);
        			$anschlussZk2->setChecked(true);
        			$anschlussZk3->setChecked(true);
        			$anschlussZk4->setChecked(true);
        			$anschlussZk5->setChecked(true);
        			$anschlussZk6->setChecked(true);
        		}
        		
        		if($anschlussTm == null){
        			$anschlussTm->setValue($form->getMaxThermo());
        			$anschlussTm = $form->getMaxThermo();
        		}
        		
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







