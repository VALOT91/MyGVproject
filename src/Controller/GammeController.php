<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ProductRepository;
 
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitConditionnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GammeController extends AbstractController
{
    #[Route('/gamme', name: 'gamme_index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('customer/gamme/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('gamme/liste/{id}', name: 'gamme_liste', methods: ['GET'])]
    public function liste(int $id,CategoryRepository $CategoryRepository, ProductRepository $productRepository,ProduitConditionnementRepository $produitConditionnementRepository): Response
    {
        $articles = [] ; 
    
        $products = $productRepository->findBy(array('category' => $id));

        foreach( $products as $item  )
        {
             $article = new Article();

             $article->product = $item;
             $article->conditionnements = $produitConditionnementRepository->findBy(array('produit' => $item->getId()));
             $articles[] = $article;
        }


      
       //dd($articles[0]->getConditionnements()[0]->getTarifs()[1]);
        
        return $this->render('customer/gamme/liste.html.twig', [
            'articles' => $articles,'category'=> $CategoryRepository->find($id)
            
        ]);
    } 

    #[Route('gamme/show/{id}', name: 'gamme_show', methods: ['GET'])]
    public function show(int $id,CategoryRepository $CategoryRepository, ProductRepository $productRepository,ProduitConditionnementRepository $produitConditionnementRepository): Response
    {
        $articles = [] ; 
    
        $products = $productRepository->findBy(array('category' => $id));

        foreach( $products as $item  )
        {
             $article = new Article();

             $article->product = $item;
             $article->conditionnements = $produitConditionnementRepository->findBy(array('produit' => $item->getId()));
             $articles[] = $article;
        }
       

      
       //dd($articles[0]->getConditionnements()[0]->getTarifs()[1]);
        
        return $this->render('customer/gamme/show.html.twig', [
            'articles' => $articles,'category'=> $CategoryRepository->find($id)
            
        ]);
    } 

}
