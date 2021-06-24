<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Uploader
{
    /**
     * @param UploadedFile $uploadedFile
     * @param string $uploadDirectory
     * @return string
     */
    public function upload(UploadedFile $uploadedFile,string $uploadDirectory, string $nom, string $prenom){

        $newFilename = $nom."-".$prenom."-".uniqid('', true).".".$uploadedFile->guessExtension();
        try{
            $uploadedFile->move($uploadDirectory,$newFilename);
        }catch (FileException $fe){
            dd($fe->getMessage());
        }
        return $newFilename;
    }
}