<?php

namespace App\Controller;
 
use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Search\SearchArticles;
use App\Form\SearchArticlesType;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('customer/Infosnews')]
class InfosNewsController extends AbstractController
{
    // affiche la liste des infos 
    #[Route('customer/Infosnews', name: 'infosNews_liste', methods: ['GET'])]
    public function index(Request $request,ArticlesRepository $articlesRepository): Response
    {

        $search = new SearchArticles();     // champ de recherche

        $form = $this->createForm(SearchArticlesType::class,$search);

        $form->handleRequest($request);

        $articles = $articlesRepository->findByKeyWords($search);

        return $this->render('customer/articles/liste.html.twig', [
            'articles' =>$articles,'form' => $form->createView()
        ]);
    }

    // affiche le detail d'un article
    #[Route('/{id}', name: 'infosNews_show', methods: ['GET'])]
    public function show(Articles $article): Response
    {
        return $this->render('customer/articles/show.html.twig', [
            'article' => $article,
        ]);
    }

}