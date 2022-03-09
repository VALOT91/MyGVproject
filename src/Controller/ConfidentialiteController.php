<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConfidentialiteController extends AbstractController
{
    #[Route('/confidentialite', name: 'Confidentialite')]
    public function index(): Response
    {
        return $this->render('customer/Confidentialite/index.html.twig');
    }
}