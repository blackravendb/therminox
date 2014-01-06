<?php

class Zend_View_Helper_LoggedIn extends Zend_View_Helper_Abstract
{
	public function loggedIn ()
	{
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()) {
			$vorname = $auth->getIdentity()->vorname;
			$logoutUrl = $this->view->url(array('controller'=>'account', 'action'=>'logout'));
			return 'Willkommen, ' . $vorname . '. <a href="/account/profile">Mein Profil</a> <a href="/angebot">Meine Angebote</a> <a href="' . $logoutUrl .'">Abmelden</a>';
			
		}

		$request = Zend_Controller_Front::getInstance()->getRequest();
		$controller = $request->getControllerName();
		$action = $request->getActionName();
		if($controller == 'account' && $action == 'login') {
			return '';
		}
		$loginUrl = $this->view->url(array('controller'=>'account', 'action'=>'login'));
		$registerUrl = $this->view->url(array('controller'=>'account', 'action'=>'register'));
		return  '<a href="' . $loginUrl . '"> Anmelden </a>' . ' - ' . '<a href="' . $registerUrl . '"> Registrieren </a>';
		
	}
}