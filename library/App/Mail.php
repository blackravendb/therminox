<?php
class App_Mail extends Zend_Mail
{
	protected $view;
	
	/**
	 * Initializes Email and View
	 * @param string $charset
	 */
	public function __construct($charset = 'UTF-8')
	{
		parent::__construct($charset);
		$this->view = new Zend_View;
		$this->view->setScriptPath(APPLICATION_PATH . '/../application/views/emails/');
	}
	
	/**
	 * assigns values to the view as key => values pairs
	 * @param array $params
	 */
	public function assignValues($params) {
		foreach ($params as $key => $value) {
			$this->view->$key = $value;
		}
	}	
	
	/**
	 * sends the email
	 * @param String $scriptname
	 */
	public function send($scriptname){
		$content = $this->view->render($scriptname . '.phtml');
		parent::setBodyHtml($content);
		parent::send();
	}
}