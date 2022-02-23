<?php 

namespace App\Services;

use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class HandleImage
{
    private $slugger;
    private $parameterBag;

    public function __construct(SluggerInterface $slugger,ParameterBagInterface $parameterBag)
    {
        $this->slugger = $slugger;
        $this->parameterBag = $parameterBag;
    }

    public function save(UploadedFile $file)
    {
         //Je recupere le nom du fichier
         $originalFileName = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
         //Securiser le nom du fichier
         $safeFileName = $this->slugger->slug($originalFileName);
         //Rendre unique le nom du fichier 
         $uniqFileName = $safeFileName . '-' . md5(uniqid()) . '.' . $file->guessExtension();
         //Sauvegarder le fichier dans un dossier préconfiguré
         $file->move(
             $this->parameterBag->get('app_images_directory'),
             $uniqFileName
         );
   
        return '/uploads/images/' . $uniqFileName;
    }

    public function edit(UploadedFile $file, string $oldImage)
    {
        $fileOldImage = $this->parameterBag->get('app_images_directory') . '/../..' . $oldImage;

        if(file_exists($fileOldImage))
        {
            unlink($fileOldImage);
        }
    }
}