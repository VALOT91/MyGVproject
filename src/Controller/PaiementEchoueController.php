<?php

namespace App\Controller;
 
 
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

 
// affichage de la page echec de paiement
#[Route('customer/echec')]
class PaiementEchoueController extends AbstractController
{
    #[Route('/', name: 'paiementEchoue', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('customer/paiement/paiementEchoue.html.twig') ;
    }

}