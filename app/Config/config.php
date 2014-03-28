<?php
/**
 * Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Project URL
 * local development == "127.0.0.1" or "localhost" (plus sub-folder)
 * hosted == "fruitify.io"
 */
define('URL', 'http://127.0.0.1/fruitBin/');

//start a session for use in getting inputs
if (!isset($_SESSION)) {
    session_start();
}

define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');

//DIRS & PATHS
define('TMP_DIR', '../../TmpFiles/');
$upload_dir = TMP_DIR;

//autoload every OOP Class in directory 
spl_autoload_register(function($class) {require_once '../Classes/'.$class.'.class.php';} );


?>