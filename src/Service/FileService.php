<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileService
{
    private $targetDirectory;
    private $extentionsAccept;

    public function __construct($targetDirectory, $extentionsAccept)
    {
        $this->targetDirectory = $targetDirectory;
        $this->extentionsAccept = $extentionsAccept;
    }

    /**
    * @return STRING || false  
    */
    public function upload(UploadedFile $file)
    {
        if(in_array($file->guessExtension(), $this->extentionsAccept())){
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $fileName = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();
    
            try {
                $file->move($this->getTargetDirectory(), $fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
    
            return $fileName;
        }

        return false;
    }

    private function getTargetDirectory()
    {
        return $this->targetDirectory;
    }

    private function extentionsAccept()
    {
        return $this->extentionsAccept;
    }
}
