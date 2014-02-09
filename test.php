<?php
/*
TEST PAGE for LEARNING AND CODING
 */


// added to ensure all required configs and OOP Classes get loaded for use
require_once (__DIR__.'/core/init.php');

echo "//////////////////////* Salts & Hashing *//////////////////////</br>";

//test input string set before running test
$plainText = "test";

$salt = Hash::salt(32); 

$hashedText = Hash::make($plainText, $salt);

//makes blank text output pretty in HTML :)
echo "<pre>";

echo "Below is the mcrypt Salt (may include spaces) :</br>[ ".$salt." ]";

echo '</br></br>This is the input test String: "'.$plainText.'"</br>';

echo "</br>Below is the Hashed result: </br>[ ".$hashedText." ]</br>";

echo "</br>//////////////////////* Working with DB *//////////////////////</br>";

//utilize getInstance instead of Contsructor (which is set as Private) becasue this will allow us to
// reference the current instance of the PDO object, and in future can allow for multiple PDO's to be in use
$testDB = DB::getInstance();

/*set fields array which will be used to insert into the DB
you must pass the hashed value for whatever you want to store in addition to the salt 
without the salt there is no way of ever recovering the hashed input ever again

SYNTAX: $fields = array(
				'column_name_in DB' => 'value to insert',	
				'column_name_in DB' => 'value to insert');
*/	

$fields = array(
			'test' => $hashedText, 
			'salt' => $salt
	);

//check insert function - if fail then give error message - add TABLE string and verify FIELDS array first
if ($testDB->insert('testTable', $fields)) { throw new Exception('There was a problem :('); }

//now query to get the hashed value back form the DB - SELECT* to get everything back - pass this in using STRING 
//directrly through query function if errors, may need to pass an empty array to satisfy args but 
//it is set as defined in the function args
$sql = "SELECT * FROM testTable";

$query = $testDB->query($sql);

echo "</br>This is a testprint from the query:</br>";

var_dump($query);

echo "</br>";

$result = $testDB->results();

echo "</br>This is what has been returned from the DB Query: </br>";

print_r($result);

//This is does not give us the actual plain text input only the hashed output

?>