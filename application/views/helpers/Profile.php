<?php

class Zend_View_Helper_Profile extends Zend_View_Helper_Abstract
{
	public function Profile($data)
	{
		if(isset($data)) {
			$output = '<ul class="data">';
			if(isset($data['email'])){
				$output .= '<li>E-mail: ' . $data['email'] . '</li>';
			}
			if(isset($data['title'])){
				$output .= '<li>Anrede: ' . $data['title'] . '</li>';
			}
			if(isset($data['name'])){
				$output .= '<li>Vorname: ' . $data['name'] . '</li>';
			}
			if(isset($data['lastname'])){
				$output .= '<li>Nachname: ' . $data['lastname'] . '</li>';
			}
			$output .= '</ul><a href="/account/profile/edit/true/"> Profil ändern </a>';
			
			return $output;
		}
	}
}