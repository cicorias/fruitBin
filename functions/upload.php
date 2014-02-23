<?PHP

//set DIR for file storage
$upload_dir = "../UploadedFiles/";

if (!is_dir($upload_dir)) { mkdir($upload_dir, 0755);}

//array to set allowed file types

$allowedexts = array("php");

//must reference the same name as HTTP form uses
if (!empty($_FILES["input"])) {
    //must reference the same name as HTTP form uses - this sets the subarray form the most recently upladed file to  == $file
    $file = $_FILES["input"];
	
	//check for PHP errrors form upload 
    if ($file["error"] !== UPLOAD_ERR_OK) { echo "<p>An error occurred.</p>"; die; }
    
    //VERIFY WHAT THE USER HAS UPLAODED TO BE NON MALICIOUS FIRST!
    
    //checksname length & size
    if(mb_strlen($file["name"],"UTF-8") > 225) { echo "<p>Filename must be under 250 chars in length</p>"; die; }
    //check that name is valid chars - if not attempt to fix - google tenerary logical operators for syntax help :)
    ((preg_match("`^[-0-9A-Z_\.]+$`i", $file['name'])) ? $name = $file["name"] : $name = preg_replace("/[^A-Z0-9._-]/i", "_", $file["name"]));
    //check file extension by first breaking name up into chunks seperated @ by .
    $tmp = explode ( '.', $name);
    //get the extension as a string
    $ext = $tmp[count($tmp)-1];
    
    //check to make sure file size and ext are ok before saving the file
 	if (in_array($ext, $allowedexts)) {
 		//save the file but check for pre-existing files first with same names
	    $i = 0;
    	$parts = pathinfo($name);
    	//chcks if file exists - if it does it adds a number to the name
    	while (file_exists($upload_dir.$name)) {
        	$i++;
        	$name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    	}
    	// preserve file from temp dir
    	$upload_path = $upload_dir . $name; 

    	$moveFile = move_uploaded_file($file["tmp_name"], $upload_path);
    	if (!$moveFile) { echo "<p>Unable to save file.</p>"; die; }
    	// set proper permissions on the new file
    	chmod($upload_path, 0644);
    	/*NOTE - may need to tweak php.ini settings for file uplaods still ie:
    	post_max_size = 8M
		upload_max_size = 2M
		max_file_uploads = 20
		ALSO - look into adding virus scanning - google ClamAV + PHP ? WHat ar ethe other alternatives?*/
	}
}
?>