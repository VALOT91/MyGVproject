<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Search\SearchProduct;
use App\Form\SearchProductType;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('admin/product')]
class ProductController extends AbstractController
{
    // afficahge de la liste des produits
    #[Route('admin/product', name: 'product_index', methods: ['GET'])]
    public function index(Request $request,ProductRepository $productRepository,PaginatorInterface $paginator ): Response
    {
        $search = new SearchProduct();

        $form = $this->createForm(SearchProductType::class,$search);

        $form->handleRequest($request);

        // $products = $productRepository->findByFilter($search);    //filtre 
         
        $products = $paginator->paginate($productRepository->findByFilter($search), $request->query->getInt('page', 1), 5);


        return $this->render('admin/product/index.html.twig', [
            'products' => $products,'form' => $form->createView()
           
        ]);
    }

    // affichage de la page formulaire du nouveau produit
    #[Route('admin/product/new', name: 'product_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,CategoryRepository $categoryRepository): Response
    {
        $product = new Product(); 


      
        $form = $this->createForm(ProductType::class, $product,['categ' => $categoryRepository->findAll()] );  // renvoi toutes les categories pour le compo
        $form->handleRequest($request);

        


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/product/new.html.twig', [
            'product' => $product,
            'form' => $form,
           
           
        ]);
    }
    
    // affiche le detail d'un produit
    #[Route('/{id}', name: 'product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('admin/product/show.html.twig', [
            'product' => $product,
        ]);
    }

    // affiche le formulaire d'edition
    #[Route('/{id}/edit', name: 'product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product,CategoryRepository $categoryRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductType::class, $product,['categ' => $categoryRepository->findAll()] );  // categ contient les categories pour le combo
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    // supprime le produit
    #[Route('/{id}', name: 'product_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
    }
}
