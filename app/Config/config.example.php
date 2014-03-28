<?php
/**
 * Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/*PROJECT URL/HOST*/

### LOCAL DEV == "127.0.0.1" or "localhost" (plus sub-folder) ###
define('URL', 'http://127.0.0.1/fruitBin/');
define('HOSTED', 'LOCAL');

### HOSTED == "fruitify.io" ###
//define('URL', 'http://fruitify.io');
//define('HOSTED','ip-adress');

define('DB_TYPE', 'mysql');

if (HOSTED == LOCAL) {
    define('DB_HOST', '127.0.0.1');
    define('DB_NAME', '');
    define('DB_USER', '');
    define('DB_PASS', '');
} else {
    define('DB_HOST', '');
    define('DB_NAME', '');
    define('DB_USER', '');
    define('DB_PASS', '');
}

//DIRS & PATHS
define('TMP_DIR', '../../TmpFiles/');
$upload_dir = TMP_DIR;

//autoload every OOP Class in directory
spl_autoload_register(function ($class) {require_once '../Classes/'.$class.'.class.php';} );

if (!isset($_SESSION)) {
    session_start();
}
