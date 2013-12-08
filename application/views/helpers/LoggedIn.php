<?php

class Zend_View_Helper_LoggedIn extends Zend_View_Helper_Abstract
{
	public function loggedIn ()
	{
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()) {
			$email = $auth->getIdentity()->vorname;
			$logoutUrl = $this->view->url(array('controller'=>'account', 'action'=>'logout'), null, true);
			return 'Willkommen, ' . $email . ". <a href='{$logoutUrl}'>Abmelden</a>";
		}

		$request = Zend_Controller_Front::getInstance()->getRequest();
		$controller = $request->getControllerName();
		$action = $request->getActionName();
		if($controller == 'account' && $action == 'login') {
			return '';
		}
		$loginUrl = $this->view->url(array('controller'=>'account', 'action'=>'login'));
		return  "<a href='$loginUrl'>Anmelden</a>";
	}
}