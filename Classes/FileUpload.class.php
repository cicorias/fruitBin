<?PHP

public function fileUploaded()
{
    if(empty($_FILES)) {
        return false;       
    } 
    $this->file = $_FILES[$this->formField];
    if(!file_exists($this->file['tmp_name']) || !is_uploaded_file($this->file['tmp_name'])){
        $this->errors['FileNotExists'] = true;
        return false;
    }   
    return true;
}

?>