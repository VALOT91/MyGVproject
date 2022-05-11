<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    // affiche la page home
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('customer/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
