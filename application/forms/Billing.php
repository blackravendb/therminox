<?php

class Application_Form_Profile extends App_Form
{
	public function init()
    {
    	$this->setMethod('post')
    	->setAction('/account/profile')
    	->setAttrib('id', 'profile');
    }
}

