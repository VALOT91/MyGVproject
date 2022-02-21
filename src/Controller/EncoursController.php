<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EncoursController extends AbstractController
{
    #[Route('/encours', name: 'encours')]
    public function index(): Response
    {
        return $this->render('encours/index.html.twig', [
            'controller_name' => 'EncoursController',
        ]);
    }
}
