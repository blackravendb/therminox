<?php
class App_Controller_Plugin_ACL extends Zend_Controller_Plugin_Abstract {
	
	protected $_auth = null;
	protected $_acl = null;
	
	public function __construct() {
		$this->_auth = Zend_Auth::getInstance ();
		$this->_acl = new App_Acl ();
	}
	
	public function preDispatch(Zend_Controller_Request_Abstract $request) {
		
		$session = new Zend_Session_Namespace('mysession');
		$controller = $request->getControllerName();
		$action = $request->getActionName();
		$role = null;
		
		if ($this->_auth->hasIdentity()) {
			if (isset($this->_auth->getIdentity()->berechtigung)){
				$role = $this->_auth->getIdentity()->berechtigung;
			} else {
				$role = 'Gast';
			}
		} else {
			$role = 'Gast';
		}
		
		if (!$this->_acl->has($controller)) {
			$controller = null;
		}
		
		if (!$this->_acl->isAllowed($role, $controller, $action)) {
			if ('Gast' == $role) {
				$session->destination_url = $request->getPathInfo();
				$request->setControllerName('account');
				$request->setActionName('login');
			} else {
				$request->setControllerName('error');
				$request->setActionName('index');
			}
		}
	}
}