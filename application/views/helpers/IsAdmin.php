<?php
class Zend_View_Helper_IsAdmin extends Zend_View_Helper_Abstract
{
	public function isAdmin()
	{
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()) {
			return $auth->getIdentity()->berechtigung === 'Administrator';		
		} else {
			return false;
		}
	}
}