<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServicesController extends AbstractController
{
    #[Route('/client/services', name: 'services')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        
        $Categories = $categoryRepository->findBy(array('gamme' => 'SE'));

        return $this->render('customer/services/index.html.twig', [
            'categories'=> $Categories,
        ]);
    }
}
