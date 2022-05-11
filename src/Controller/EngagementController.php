<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EngagementController extends AbstractController
{
    // affichage de la page engagements
    #[Route('/engagement', name: 'engagement')]
    public function index(): Response
    {
        return $this->render('customer/engagement/index.html.twig');
       
    }
}
