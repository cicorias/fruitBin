<?php
/* Input allows for saving and access of any $_POST or $_GET data*/

class Input {

	public static function exists($type = 'post', $item = null) {
		switch ($type) {
			case 'post':
				if(!$item == null) { return (!empty($_POST[$item])) ? true : false; }
				else return (!empty($_POST)) ? true : false;
				break;
			case 'get':
				if(!$item == null) { return (!empty($_GET[$item])) ? true : false; }
				else return (!empty($_GET)) ? true : false;
				break;
			case 'files':
				if(!$item == null) { return (!empty($_FILES[$item])) ? true : false; }
				else return (!empty($_FILES)) ? true : false;
				break;
			default:
				return false;
				break;
		}
	}

	public static function get($item, $subItem = null) {
		if (!$subItem == null) {
			if (isset($_POST[$item])) { return $_POST[$item][$subItem];}
			if (isset($_GET[$item])) { return $_GET[$item][$subItem];}
			if (isset($_FILES[$item])) { return $_FILES[$item][$subItem];}
		} 

		else {
			if (isset($_POST[$item])) {return $_POST[$item];}
			if (isset($_GET[$item])) {return $_GET[$item];}
			if (isset($_FILES[$item])) {return $_FILES[$item];}
		} 			
		return  '';
	}
}
?>