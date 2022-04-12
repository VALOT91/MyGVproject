<?php

namespace App\Controller;
 
use App\Form\ArticlesType;
use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('customer/Infosnews')]
class InfosNewsController extends AbstractController
{
    #[Route('customer/Infosnews', name: 'infosNews_liste', methods: ['GET'])]
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('customer/articles/liste.html.twig', [
            'articles' => $articlesRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'infosNews_show', methods: ['GET'])]
    public function show(Articles $article): Response
    {
        return $this->render('customer/articles/show.html.twig', [
            'article' => $article,
        ]);
    }






}