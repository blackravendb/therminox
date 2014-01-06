<?php

class Application_Form_Shipping extends App_Form
{
	public function init()
    {
    	$this->setMethod('post')
    	->setAction('/account/shipping')
    	->setAttrib('id', 'profile');
    }
}

