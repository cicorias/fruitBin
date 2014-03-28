<?php

require_once ('../core/init.php');

$validation = new Validate;
$type = '';
$uploaded = false;

if (!is_dir($upload_dir)) { mkdir($upload_dir, 0755);}
// if creating the dir fails and dir is not there - we need to handle that error

//check that post data has been submit, menaing this page has been reached because the form was submitted
if (Input::exists()) {
    
    //check that the PHP native $_FILES array has something in it
    if (Input::exists('files')) {
        
    	//check for PHP errors from the upload, must specify the exact same name as was used in the http form on index page
        if  (!Input::get('file','error') == UPLOAD_ERR_OK) { echo "ERROR: " . Input::get('file','error') . "<br>"; }
        
        //USE VALIDATION CLASS TO CHECK IF THIS FILE IS VALID OR NOT
        $validate->checkInput();

        $type = 'file';
    }

    //check if the textbox was used from the index page
    if (Input::exists('post','textbox')) {

        //USE VALIDATION CLASS TO CHECK IF THIS FILE IS VALID OR NOT
        $validate->checkInput(Input::get('post','textbox'));

        $type = 'textbox';
    }

    // preserve file from temp dir if validation passed
    if ($validate->passed()) { 

        $upload_path = $upload_dir . $validate->filename();    
    
        //moves file from php.ini designated temp_dir to the specified global Uploads Dir
        if ($type == 'file') { $moveFile = move_uploaded_file(Input::get('file','temp_name'), $upload_path); } 

        //write new file
        if ($type == 'textbox') { $newfile = file_put_contents($upload_path, $validate->content()); }

        if ($moveFile || $newfile) { $uploaded = true; } 

        if ($uploaded) {
            
            // set proper permissions on the new file
            chmod($upload_path, 0755);

            echo "<p>" . $validate->filename() . " has been uploaded to: " . $upload_path . "</br>";

        } else { echo "<p>Unable to save file.</p>"; die; }
              
    } else {//VALIDATION FAILED

        //print out any validation errors
        echo ("<p><ul>");

        foreach ($validate->errors() as $error) { print_r("<li>" . $error . "</li><"); } 

        echo ("</ul></p>");         
    }
}
/*NOTE - may need to tweak php.ini settings for file uplaods still ie:
            post_max_size = 8M
            upload_max_size = 2M
            max_file_uploads = 20
            ALSO - look into adding virus scanning - google ClamAV + PHP ? What ar ethe other alternatives?*/
?>