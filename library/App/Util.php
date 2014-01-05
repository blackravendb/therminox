<?php
class App_Util 
{
	/** Generates a random hexadecimal string with a standard length of 20 Bytes. => 40 hexadecimal characters.
	 *  
	 * @param number $bytes, per byte 2 hex-characters
	 * @return string hexadecimal encoded
	 */
	public static function generateHexString($bytes = 20) {
		return bin2hex(mcrypt_create_iv($bytes, MCRYPT_DEV_URANDOM));
	}
}