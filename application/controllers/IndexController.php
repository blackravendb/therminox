<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    //   $this->_redirect('/startseite');
    
    $benutzer = new Application_Model_BenutzerMapper();
    $mustermann = $benutzer->getBenutzer("max.mustermann@test.de");
    $this->view->mustermann = $mustermann;
    
    $mustermaenner = $benutzer ->fetchAll();
    $this->view->mustermaenner = $mustermaenner;
    }


}

