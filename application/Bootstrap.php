<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initDoctype()
	{
		$this->bootstrap('view');
		$view = $this->getResource('view');
		$view->setEncoding('UTF-8');
		$view->doctype('HTML5');
		$view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
		$view->headTitle('Therminox Wärmetechnik')->setSeparator(' - ');
		$view->headLink()->appendStylesheet('/_files/css/layout.css');
		$view->headLink()->appendStylesheet('/_files/css/menu.css');
		$view->headLink()->appendStylesheet('/_files/css/marko.css');
		$view->headScript()->appendFile('/_files/js/global.js');
	}
	
// 	protected function _initDbAdapter(){
// 		$profiler = new Zend_Db_Profiler_Firebug('All DB Queries');
// 		$profiler->setEnabled(true);
// 		$dbAdapter->setProfiler($profiler);
// 	}
	
	protected function _initLocale()
	{
		try {
			$locale = new Zend_Locale();
			if(!$locale->getRegion()) {
				$locale = new Zend_Locale('de_DE');
			}else if(count($locale->getTranslationList('Territory', $locale->getLanguage(), 2)) > 240) {
				$locale = new Zend_Locale('de_DE');
			}
		} catch(Zend_Locale_Exception $e) {
			$locale = new Zend_Locale('de_DE');
		} 
		Zend_Registry::set('Zend_Locale', $locale);
	}
	
	protected function _initEmail()
	{
		$config = array(
			'auth' => 'login',
			'ssl' => 'tls',
			'port' => 587,
			'username' => 'test.therminox@gmail.com',
			'password' => 'asdF123$'
		);
		$transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
		Zend_Mail::setDefaultTransport($transport);
	}

	protected function _initViewHelpers()
	{
		$view = new Zend_View();
		$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
		$view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');

		// Use locale jquery lib in /public/js
// 		$view->jQuery()->addStylesheet('/js/jquery/css/smoothness/jquery-ui-1.10.3.custom.min.css')
// 		->setLocalPath('/js/jquery/js/jquery-1.10.2.min.js')
// 		->setUiLocalPath('/js/jquery/js/jquery-ui-1.10.3.custom.min.js');
		
		//Use jquery lib from google CDN (better than local)
		$view->jQuery()->enable()->uiEnable()//enable jquery ; ->setCdnSsl(true) if need to load from ssl location
 		->setVersion('1.10.2')->setUiVersion('1.10.3')
 		->addStylesheet('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.min.css');
		

		$viewRenderer->setView($view);
		Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
	}
	
	protected function _initPlugins()
	{
		$front = Zend_Controller_Front::getInstance();
		$front->registerPlugin(new App_Controller_Plugin_ACL());
	}
	
	protected function _initSession()
	{
		Zend_Session::start();
	}
}