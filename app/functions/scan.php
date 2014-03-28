<?php
/* Logic for back end scanning*/

require_once ('../core/init.php');
//initial check for uplaod dir - same as upload.php
if (!is_dir($upload_dir)) { mkdir($upload_dir, 0755);}

//create DirIterator for working with the dir
$files = new DirectoryIterator($upload_dir);
foreach ($files as $file) {
    if (!$file->isDot()) {
        print_r($file->getFilename());
    }
    
}

?>