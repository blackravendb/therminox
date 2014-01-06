<?php
class App_Form extends Zend_Form
{
	function __construct()
	{
		parent::__construct();
		$this->addElement('hash', 'csrf_token', array(
				'ignore' => true,
				'salt' => get_class($this) . 'unique',
				'decorators' => array('ViewHelper')
		));
	}
	
	protected $elementDecorators = array(
			'ViewHelper',
			array(
					array('data' => 'HtmlTag'),
					array('tag' => 'td')
			),
			array(
					array('openerror' => 'HtmlTag'),
					array('tag' => 'td', 'openOnly' => true, 'placement' => Zend_Form_Decorator_Abstract::APPEND)
			),
			'Errors',
			array(
					array('closeerror' => 'HtmlTag'),
					array('tag' => 'td', 'closeOnly' => true, 'placement' => Zend_Form_Decorator_Abstract::APPEND)
			),
			array('Label',
					array('tag' => 'td')
			),
			array(
					array('row' => 'HtmlTag'),
					array('tag' => 'tr')
			)
	);
	
	protected $buttonDecorators = array(
			'ViewHelper',
			array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
			array(array('label' => 'HtmlTag'), array('tag' => 'td', 'placement' => 'prepend')),
			array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
	);
	
	public function loadDefaultDecorators()
	{
		$this->setDecorators(array(
				'FormElements',
				array('HtmlTag', array('tag' => 'table')),
				'Form',
		));
	}
}