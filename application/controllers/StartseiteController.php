<?php

class StartseiteController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
           $test = new Application_Model_BegriffeMapper();
           $this->view->entries = $test->fetchAll();
    }


}

