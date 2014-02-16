<?php
/*
TEST PAGE for LEARNING AND CODING
 */


// added to ensure all required configs and OOP Classes get loaded for use
require_once (__DIR__.'/core/init.php');

// COMMENTED OUT FOR NOW DUE TO NO SQL SCHEME IN USE WILL DECIDE AT LATER POINT HOW TO HANDLE USER DATA,
// FOR TESTING SIMPLY UNCOMMENT the following Line Numbers: (13 - 79)

// echo "//////////////////////* Salts & Hashing *//////////////////////</br>";

// //test input string set before running test
// $plainText = "test";

// $salt = Hash::salt(32); 

// $hashedText = Hash::make($plainText, $salt);

// //makes blank text output pretty in HTML :)
// echo "<pre>";

// echo "Below is the mcrypt Salt (may include spaces) :</br>[ ".$salt." ]";

// echo '</br></br>This is the input test String: "'.$plainText.'"</br>';

// echo "</br>Below is the Hashed result: </br>[ ".$hashedText." ]</br>";

// echo "</br>//////////////////////* Working with DB *//////////////////////</br>";

// //utilize getInstance instead of Contsructor (which is set as Private) becasue this will allow us to
// // reference the current instance of the PDO object, and in future can allow for multiple PDO's to be in use
// $testDB = DB::getInstance();

// set fields array which will be used to insert into the DB
// you must pass the hashed value for whatever you want to store in addition to the salt 
// without the salt there is no way of ever recovering the hashed input ever again

// SYNTAX: $fields = array(
// 				'column_name_in DB' => 'value to insert',	
// 				'column_name_in DB' => 'value to insert');
	
// echo "</br>INSERTING THE ABOVE INTO THE DB........</br> ";

// $insert = array( 
// 			'salt' => $salt,
// 			'input_string' => $hashedText
// 	);

// //check insert function - if fail then give error message - add TABLE string and verify FIELDS array first
// if (!$testDB->insert('test', $insert)) { throw new Exception('There was a problem :('); }

// //var_dump($testDB->results());


// /*now query to get the hashed value back form the DB - SELECT* to get everything back - pass this in using STRING 
// directrly through query function if errors, may need to pass an empty array to satisfy args but 
// it is set as defined in the function args*/

//  $sql = "SELECT * FROM test";

//  $query = $testDB->query($sql);

//  echo "PRINTED RESULTS FROM THE DB QUERY: </br>";

//  $results = ($testDB->results());

//  foreach ($results as $result) {
 		
//  		foreach ($result as $key => $value) { print_r("</br>[".$key."] = ".$value.";"); }
//  }	

// echo "</br> Notice the output is the hashed text and NOT the plain text.... </br>";


// echo "</br> It is literally impossible to get the inupt plain text from the hashed text from the database</br>
// If you wanted you coul dverify the data by checking the hashvalue of a given string to the stored hashed text</br></br>";
/* UNFINISHED NESTED LOOP FOR CHECKING THE HASH - NOT NEEDED BRING UP IN MEETING FOCUS ON BUIDING SCAN FOR NOW
// foreach ($results as $result) {
 		
//  	foreach ($result as $key => $value) { 

//  		if ($key = 'input_string') {
 		
//  			if (Hash::make($plainText,$result['salt']) == $result['input_string']) {
 	
//  				print_r("</br>[".$key."] = ".$plainText.";");				
//  			}
//  		}
			
// 		print_r("</br>[".$key."] = ".$value.";");
 		
//  	}
//  } */

echo "</br>//////////////////////* Working with File Uploads *//////////////////////</br>";

?>
<!-- start html - list a form for testing file uplaods -->
<form action="" method="post" 
    enctype="multipart/form-data"> 
  <div><label id="upload">Select file to upload: 
    <input type="file" id="upload" name="upload"/></label></div> 
  <div> 
    <input type="hidden" name="action" value="upload"/> 
    <input type="submit" value="Submit"/> 
  </div> 
</form>

?>