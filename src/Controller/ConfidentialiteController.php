<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConfidentialiteController extends AbstractController
{
    // affiche la page de la politique de confidentialité
    #[Route('/confidentialite', name: 'Confidentialite')]
    public function index(): Response
    {
        return $this->render('customer/confidentialite/index.html.twig');
    }
}