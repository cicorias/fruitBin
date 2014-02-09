<?php
//start a session for use in getting inputs
session_start();

//set global array for DB use, etc ; session info only needed if we add functionality in later on to support
// unique users
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'username',
		'password' => 'password',
		'db' => 'database_name'),
	/*'session' => array(
		'session_name' => 'user',
		'token_name' => 'token')*/);

//autoload every OOP Class in directory
spl_autoload_register(function($class) {require_once 'Classes/'.$class.'.php';} );

?>