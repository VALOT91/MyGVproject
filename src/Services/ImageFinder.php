<?php

namespace App\Services;

use Symfony\Component\Finder\Finder;

class ImageFinder
{
    public function GetUploadDirectory()
    {
        $finder = new Finder();
            
        $filesRep = $finder
            ->files()
            ->in("uploads")
            ->sortByChangedTime()
            ->getIterator()
        ;
        $filesTab = [];    
        foreach($filesRep  as $item )
        {
            $filesTab[] = $item;
        }
       
        return  $filesTab;
    }
}