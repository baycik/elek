<?php
namespace Controllers;
class Elek{
    public function index(){
    }
    
    
    public function fileUpload(){
        $tempName=$_FILES['files']['tmp_name'];
        $storedName=sprintf('./src/%s.%s',sha1_file($tempName),'.txt');
        switch ($_FILES['files']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new \Exception('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new \Exception('Exceeded filesize limit.');
            default:
                throw new \Exception('Unknown errors.');
        }
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search($finfo->file($tempName),['txt' => 'text/plain'],true)) {
            throw new \Exception('Invalid file format.');
        }
        if ( !move_uploaded_file($tempName,$storedName) ){
            throw new \Exception('Failed to move uploaded file.');
        }
        $ElekModel= new \Models\ElekModel();
        $ElekModel->setFile($storedName);
        $ElekModel->read();
    }
}