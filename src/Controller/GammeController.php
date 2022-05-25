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
use Knp\Component\Pager\PaginatorInterface;

class GammeController extends AbstractController
{
    // affichage de la liste des catégories (gamme)
    #[Route('/gamme', name: 'gamme_index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        // TH permet de filtrer les catégories de la gamme thé (il y a deux gammes : thé et services)
        $Categories = $categoryRepository->findBy(array('gamme' => 'TH'));

        return $this->render('customer/gamme/index.html.twig', [
            'categories' =>  $Categories,
        ]);
    }

    // liste des produit d'une catégorie précise
    #[Route('gamme/liste/{id}', name: 'gamme_liste', methods: ['GET'])]
    public function liste(int $id,CategoryRepository $CategoryRepository, ProductRepository $productRepository,PaginatorInterface $paginator,  Request $request,ProduitConditionnementRepository $produitConditionnementRepository): Response
    {
        $articles = [] ; 
    
        $products = $productRepository->findBy(array('category' => $id));   // filtre les produits par catégorie

        foreach( $products as $item  )     // boucle foreach sur tous les produits d'une catégorie
        {
             $article = new Article();

             $article->product = $item;
             $conditionnements = $produitConditionnementRepository->findBy(array('produit' => $item->getId()));
             $article->conditionnements =  $conditionnements;
            
              // n'affiche pas les produits sans conditionnement
              if(count($article->conditionnements)> 0)
               {   
                   $tarifCount=0;
                   foreach( $article->conditionnements as $conditionnement  )   // un produit peut être disponible en plusieurs conditionnements
                   {
                        // n'affiche pas les conditionnements sans tarifs
                        if(count($conditionnement->getTarifs()) >0)
                                     $tarifCount++;
                   }
                   
                   if( $tarifCount)
                      $articles[] = $article;
               }
                
        }
 
        //  prepare la pagination
         $articles = $paginator->paginate($articles, $request->query->getInt('page', 1), 4);
            // dd($articles);
            return $this->render("customer/gamme/liste.html.twig",[
                'articles' => $articles,'category'=> $CategoryRepository->find($id)
            ]); 
    } 

    // affiche un détail produit ( table produitConditionnement )
    #[Route('gamme/show/{id}', name: 'gamme_show', methods: ['GET'])]
    public function show(int $id,CategoryRepository $CategoryRepository, ProductRepository $productRepository,ProduitConditionnementRepository $produitConditionnementRepository): Response
    {
        $articles = [] ; 
    
        $product = $productRepository->find($id);
       
       $conditionnement=$produitConditionnementRepository->findBy(array('produit' =>$id));
       
        return $this->render('customer/gamme/show.html.twig', [
            'product' => $product,'conditionnements'=>$conditionnement
            
        ]);
    } 

}
