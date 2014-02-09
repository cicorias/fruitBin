<?php
/*
HASH CLASS - used fr creating salts and hashing input strings for use in the Database
 */
class Hash {

	public static function make($string, $salt = '') {
		return hash('sha256', $string . $salt);
	}

	// If (PHP mcrypt) 
	public static function salt($length) {
		return mcrypt_create_iv($length); 
	}

	public static function unique() {
		return self::make(uniqid());
	}

	// If (!PHP mcrypt) 
	/*
	public static function unique() {
		return self::make(uniqid());
	}

	public static function salt ($length) {
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
		$randString = '';
		for ($i=0;$i < $length; $i++) {
			$randString .= $chars[rand(0, strlen($chars) - 1)];
		}
		return $randString;
	}*/

}
?>