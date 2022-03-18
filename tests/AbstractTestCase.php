<?php 

namespace App\Tests;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AbstractTestCase extends KernelTestCase
{
    public function getErrorsMessages($errors)
    {
         //J'instancie un tableau pour récupérer tous les messages d'erreur
         $messages = [];

         /** @var ConstraintViolation $error */
         foreach($errors as $error)
         {
             $messages[] = $error->getMessage();
         }

         return $messages;
    }
}