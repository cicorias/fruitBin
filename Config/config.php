<?php
//start a session for use in getting inputs
session_start();

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