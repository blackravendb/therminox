<?php

class Application_Form_Delete extends App_Form
{
	public function init()
	{
		$this->setMethod('post')
		->setAction('/account/delete')
		->setAttrib('id', 'delete');
		
		$submit = new Zend_Form_Element_Submit('submit', array(
				'label' => 'Account löschen',
				'decorators' => array('ViewHelper')
		));
		
		$this->addElements(array($submit));
	}
}