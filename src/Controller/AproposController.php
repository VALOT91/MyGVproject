<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AproposController extends AbstractController
{
    // affiche la page apropos
    #[Route('/apropos', name: 'Apropos')]
    public function index(): Response
    {
        return $this->render('customer/Apropos/index.html.twig');
    }
}