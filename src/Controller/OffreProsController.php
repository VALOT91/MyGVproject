<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreProsController extends AbstractController
{
    #[Route('/offre/pros', name: 'offre_pros')]
    public function index(): Response
    {
        return $this->render('offre_pros/index.html.twig', [
            'controller_name' => 'OffreProsController',
        ]);
    }
}
