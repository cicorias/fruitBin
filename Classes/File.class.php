<?PHP

class File {
    
    private $_fileext,//hold .ext for file
    		$_allowedexts = array("php"),//array to set allowed file types
    		$_valid = false,//allows to check validity
    		$_name,//set permanent filename
    		$_location;//set a permananet location for the file after uploaded

	
	public static function fileUploaded() {
		//If a file has been uploaded then check it, and move it and give it a new name
	    
	    //must reference the same name as HTTP form uses
	    if (move_uploaded_file($_FILES['test']['tmp_name'], "/place/for/file")) {
        print "Received {$_FILES['userfile']['name']} - its size is {$_FILES['userfile']['size']}";
    } else {
        print "Upload failed!";
    }
	    
	    
	    
	}

	public function checkFile(){
		
		//CHECK THE FILE NAME & EXTENSION
		$_tmp = explode ( '.', $_FILES['filename']['ext']);

		$nameValid = ((preg_match("`^[-0-9A-Z_\.]+$`i",$_FILES['filename'])) ? true : false);
    	$nameLength = (!(mb_strlen($filename,"UTF-8") > 225) ? true : false);

    	$this->_fileext = $tmp[count($tmp)-1];

    	if (in_array($fileext, $allowedexts) && $nameValid && $nameLength) { 

    		$this->_valid = true; }

    	return $this->_valid;
	}

}
?>