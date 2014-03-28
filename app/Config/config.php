<?php
/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Configuration for: Project URL
 * Put your URL here, for local development "127.0.0.1" or "localhost" (plus sub-folder) is fine
 */
define('URL', 'http://127.0.0.1/php-mvc/');

//start a session for use in getting inputs
if (!isset($_SESSION)) {
    session_start();
}

$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => 'localhost',
		'username' => '',
		'password' => '',
		'db' => ''),
	'folders' => array(
		'uploads' => '../UploadedFiles/')
	/*'session' => array(
		'session_name' => 'user',
		'token_name' => 'token')*/);

//autoload every OOP Class in directory 
spl_autoload_register(function($class) {require_once '../Classes/'.$class.'.class.php';} );

//set global Upload dir
$upload_dir = Config::get('folders/uploads');


?>