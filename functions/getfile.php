<?php

require_once ('../core/init.php');

if (!is_dir($upload_dir)) { mkdir($upload_dir, 0755);}
// - if creating the dir fails and dir is not there - we need to handle that error

//array to set allowed file types
$allowedexts = array("php");

//check that post data has been submit, menaing this page has been reached because the form was submitted
if (Input::exists()) {
    
    //check that the PHP native $_FILES array has something in it
    if (Input::exists('files')) {
        
    	//check for PHP errors from the upload, must specify the exact same name as was used in the http form on index page
        if  (!Input::get('file','error') == UPLOAD_ERR_OK) { echo "Error: " . Input::get('file','error') . "<br>"; }
        
        //check name length & size
        if(mb_strlen(Input::get('file'),"UTF-8") > 225) { echo "<p>Filename must be under 250 chars in length</p>"; die; }
        
        //check that name is valid chars - if not attempt to fix - google tenerary logical operators for syntax help :)
        ((preg_match("`^[-0-9A-Z_\.]+$`i", Input::get('file','name'))) ? $filename = Input::get('file','name') : $filename = preg_replace("/[^A-Z0-9._-]/i", "_", Input::get('file','name')));
        
        //check file extension by first breaking name up into chunks seperated @ by .
        $tmp = explode ( '.', $filename);
        
        //get the extension as a string
        $ext = strtolower($tmp[count($tmp)-1]);
        
        //check to make sure etxtension is allowed
     	if (in_array($ext, $allowedexts)) {
     		
            //check for pre-existing files with same name
    	    $i = 0;
            $parts = pathinfo($filename);
        	
            //chcks if file exists - if it does it adds a number to the name
        	while (file_exists($upload_dir . $filename)) {
            	$i++;
            	$filename = $parts["filename"] . "-" . $i . "." . $parts["extension"];
        	}
        	
            // preserve file from temp dir
        	$upload_path = $upload_dir . $filename; 

            //moves file from php.ini designated temp_dir to the specified global Uploads Dir
        	$moveFile = move_uploaded_file(Input::get('file','temp_name'), $upload_path);

        	if (!$moveFile) { echo "<p>Unable to save file.</p>"; die; }

        	// set proper permissions on the new file
        	chmod($upload_path, 0755);
        	
            echo "<p>".$name." has been uploaded to: ".$upload_path."</br>";
        	
    	} else { 
    		echo "<p>Unable to save file. The file must be of following type(s): ";
    		foreach ($allowedexts as $allowedext) { print_r($allowedext); } 
    		echo "</p>"; die; 
    	}
    }
}
/*NOTE - may need to tweak php.ini settings for file uplaods still ie:
            post_max_size = 8M
            upload_max_size = 2M
            max_file_uploads = 20
            ALSO - look into adding virus scanning - google ClamAV + PHP ? What ar ethe other alternatives?*/
?>