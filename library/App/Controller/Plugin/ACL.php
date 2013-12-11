<?php
class App_Controller_Plugin_ACL extends Zend_Controller_Plugin_Abstract {
	
	private $_auth = null;
	private $_acl = null;
	
	public function __construct() {
		$this->_auth = Zend_Auth::getInstance ();
		$this->_acl = new App_Acl ();
	}
	
	public function preDispatch(Zend_Controller_Request_Abstract $request) {
		$controller = $request->getControllerName ();
		$action = $request->getActionName ();
		$role = null;
		
		if ($this->_auth->hasIdentity ()) {
			$role = $this->_auth->getIdentity ()->berechtigung;
		} else {
			$role = 'gast';
		}
		
		$role = 'gast'; // Zeile löschen, wenn in der Datenbank Berechtigung funktioniert
		
		if (! $this->_acl->isAllowed ( $role, $controller, $action )) {
			
			if ('gast' == $role) {
				$request->setControllerName ( 'account' );
				$request->setActionName ( 'login' );
			} else {
				$request->setControllerName ( 'error' );
				$request->setActionName ( 'index' );
			}
		}
	}
}