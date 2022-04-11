<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffresProsController extends AbstractController
{
    #[Route('/offresPro', name: 'offresPro')]
    public function index(): Response
    {
        return $this->render('customer/offrespro/index.html.twig', [
            'Offres' => 'OffresProController',]);
    }
}
