<?php

class AccountController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
		$form = new Application_Form_Login();
		if ($this->_request->isPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				echo 'success';
				exit;
			} else {
				$form->populate($formData);
			}
		}
		$this->view->form = $form;
    }

    public function logoutAction()
    {
        // action body
    }

    public function registerAction()
    {
        // action body
    }

    public function confirmAction()
    {
        // action body
    }

    public function recoverAction()
    {
        // action body
    }

    public function passwordAction()
    {
        // action body
    }

    public function profileAction()
    {
        // action body
    }


}















