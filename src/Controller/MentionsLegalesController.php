<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MentionsLegalesController extends AbstractController
{
    #[Route('/mentionslegales', name: 'MentionsLegales')]
    public function index(): Response
    {
        return $this->render('customer/mentionsLegales/index.html.twig', [
            'controller_name' => 'MentionsLegalesController',
        ]);
    }
}
