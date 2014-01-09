<?php
class App_Validate_MyPostCode extends Zend_Validate_Abstract {
	public function isValid($value, $context = null) {
		$value = ( string ) $value;
		
		if (! (is_array ( $context ) && isset ( $context ['country'] ))) {
			return true;
		}
		
		$country = $context ['country'];
		
		$locale = Zend_Locale::getLocaleToTerritory ( $country );
		try {
			$validator = new Zend_Validate_PostCode ( $locale );
		} catch (Exception $e) {
			return true;
		}
		
		return $validator->isValid($value);
	}
}
