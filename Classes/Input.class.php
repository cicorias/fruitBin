<?php
/* Input allows for saving and access of any $_POST or $_GET data*/

class Input {

	public static function exists($type = 'post') {
		switch ($type) {
			case 'post':
				return (!empty($_POST)) ? true : false;
				break;
			case 'get':
				return (!empty($_GET)) ? true : false;
				break;
			case 'files':
				return (!empty($_FILES)) ? true : false;
				break;
			default:
				return false;
				break;
		}
	}

	public static function get($item, $subItem = null) {
		if ($subItem == null) {
			if (isset($_POST[$item])) {return $_POST[$item];}
			else if (isset($_GET[$item])) {return $_GET[$item];}
			else if (isset($_FILES[$item])) {return $_FILES[$item];}
		} else {
			if (isset($_POST[$item])) {return $_POST[$item][$subItem];}
			else if (isset($_GET[$item])) {return $_GET[$item][$subItem];}
			else if (isset($_FILES[$item])) {return $_FILES[$item][$subItem];}
		}
		return  '';
	}
}
?>