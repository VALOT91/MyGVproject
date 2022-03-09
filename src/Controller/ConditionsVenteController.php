<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    class ConditionsVenteController extends AbstractController
    {
        #[Route('/CGV', name: 'ConditionsVente')]
        public function index(): Response
        {
            return $this->render('customer/conditionsVentes/index.html.twig');
        }
    }

 