<?php

class Zend_View_Helper_LoggedIn extends Zend_View_Helper_Abstract
{
	public function loggedIn ()
	{
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()) {
			$vorname = $auth->getIdentity()->vorname;
			if($auth->getIdentity()->berechtigung === 'Administrator') {
				return 'Willkommen, ' . $vorname . '.  ' . '<a href="/account/logout">Abmelden</a>';
			}
				
			return 'Willkommen, ' . $vorname . '. <a href="/account/profile">Mein Profil</a> <a href="/angebot">Meine Angebote</a> <a href="/account/logout">Abmelden</a>';
			
		}

		$request = Zend_Controller_Front::getInstance()->getRequest();
		$controller = $request->getControllerName();
		$action = $request->getActionName();
		if($controller === 'account' && $action === 'login') {
			return '';
		}
		return  '<a href="/account/login"> Anmelden </a>' . ' - ' . '<a href="/account/register"> Registrieren </a>';
		
	}
}