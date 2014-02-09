<?PHP
/*
TEST PAGE for LEARNING AND CODING
 */


// added to ensure all required configs and OOP Classes get loaded for use
require_once 'core/init.php';

// Test Salts & Hashing 

//test input string set before running test
$input = "test";

$salt = Hash::salt(32); 

$hash = Hash::make(Input::get($input), $salt);

//makes blank text output pretty in HTML :)
echo "<pre>";

echo "This is the mcrypt Salt: [ ".$salt." ]</br>";

echo "This is the input test String:".$input."</br>";

echo "This is the Hashed result: [ ".$hash." ]</br>"


?>