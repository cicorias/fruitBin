<?php

class Validate {
    
    private $_passed = false,
            $_errors = array(),
            $_db = null,
            //array to set allowed file types
            $_allowedexts = array("php"),
            $_filename,
            $_content;
    

    public function checkInput($input = null) {
        
        //Input will be null if it is a file upload - will have value if sent from textbox (array or string?)
        if ($input == null) {
            
            $name = Input::get('file','name');
            
            $input = Input::get('file');
        
        } else { 

            $name ='fruitify.php';

            $this->_content = $input;  
        }
        
        //check name length & size
        if(mb_strlen($name,"UTF-8") > 225) { $this->addError("Filename must be under 250 chars in length"); die; }
            
        //check that name is valid chars - if not attempt to fix - google tenerary logical operators for syntax help :)
        ((preg_match("`^[-0-9A-Z_\.]+$`i", $name)) ? $this->_filename = $name : $this->_filename = preg_replace("/[^A-Z0-9._-]/i", "_", $name));
            
        //check file extension by first breaking name up into chunks seperated @ by .
        $tmp = explode ( '.', $this->_filename);
            
        //get the extension as a string
        $ext = strtolower($tmp[count($tmp)-1]);
            
        //check to make sure etxtension is allowed
        if (in_array($ext, $this->_allowedexts)) {
                
            //check for pre-existing files with same name
            $i = 0;
            
            $parts = pathinfo($this->_filename);
                
            //chcks if file exists - if it does it adds a number to the name
            while (file_exists($upload_dir . $this->_filename)) {
                
                $i++;
                
                $this->_filename = $parts["filename"] . "-" . $i . "." . $parts["extension"];
            }

        } else { 
            //THIS ERROR MSG ONLY WORKS FOR ONE ALLOWED FILE TYPE IF WE ADD MORE LANGUAGES THIS HAS TO GET CHANGED
            foreach ($this->_allowedexts as $allowedext) { $this->addError("The file must be of following type(s): ." . $allowedext); } 
        }

        if (empty($this->_errors)) { $this->_passed = true; }

        return $this;      
    }

    public function content() {
        return $this->_content;
    }

    public function addError($error) {
        $this->_errors[] = $error;
    }
    
    public function errors() {
        return $this->_errors;
    }

    public function filename() {
        return $this->_filename;
    }
    
    public function passed() {
        return $this->_passed;
    }

    // public function reset() {
    //     $this->_passed = false;
    //     $this->_errors = array();
    //     $this->_db = null;
    // }
}
?>