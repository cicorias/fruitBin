<?PHP

// added to ensure all required configs and OOP Classes get loaded for use
require_once 'core/init.php';

// Test Salts & Hashing for DB

$salt = Hash::salt(32); 

?>