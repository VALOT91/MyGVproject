<?php

namespace App\Controller;

use App\Form\SearchRecetteType;
use App\Search\SearchRecette;
use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\ProductRepository;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\ImageFinder;

#[Route('admin/recette')]
class RecetteController extends AbstractController
{
    // affiche la liste des recettes
    #[Route('admin/recette/', name: 'recette_index', methods: ['GET'])]
    public function index(Request $request,RecetteRepository $recetteRepository): Response
    {
        $search = new SearchRecette();    // filtre de recherche

        $form = $this->createForm(SearchRecetteType::class,$search);

        $form->handleRequest($request);

        $redette = $recetteRepository->findByFilter($search);

        return $this->render('admin/recette/index.html.twig', [
            'recettes' => $redette ,'form' => $form->createView()
        ]);
        
    }

    // affiche le formulaire de nouvelle recette
    #[Route('/new', name: 'recette_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,ProductRepository $productRepository): Response
    {  

        $finder = new ImageFinder();
        $filesTab = $finder->GetUploadDirectory();  // charge le répertoire uploads

        $recette = new Recette();
        $form = $this->createForm(RecetteType::class, $recette,['prod' => $productRepository->findAll()]);  // données pour le combo products chargé
        
        $form->handleRequest($request);
        $oldImage = $recette->getImagePath();
       
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($recette);
            $entityManager->flush();

            return $this->redirectToRoute('recette_index', [], Response::HTTP_SEE_OTHER);
        }
       

        return $this->renderForm('admin/recette/new.html.twig', [
            'recette' => $recette,'file'=>$filesTab,
            'form' => $form,
        ]);
    }

    // affiche le detail d'une recette
    #[Route('/{id}', name: 'recette_show', methods: ['GET'])]
    public function show(Recette $recette): Response
    {
        return $this->render('admin/recette/show.html.twig', [
            'recette' => $recette,
        ]);
    }

    // affiche le formulaire d'edition d'une recette
    #[Route('/{id}/edit', name: 'recette_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recette $recette, EntityManagerInterface $entityManager,ProductRepository $productRepository): Response
    {
        $finder = new ImageFinder();
        $filesTab = $finder->GetUploadDirectory();  // charge le répertoire uploads

        $form = $this->createForm(RecetteType::class, $recette,['prod' => $productRepository->findAll()]); // données pour le combo products chargé
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('recette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/recette/edit.html.twig', [
            'recette' => $recette,'file'=>$filesTab,
            'form' => $form,
        ]);
    }

    // suppression d'une recette
    #[Route('/{id}', name: 'recette_delete', methods: ['POST'])]
    public function delete(Request $request, Recette $recette, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recette->getId(), $request->request->get('_token'))) {
            $entityManager->remove($recette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recette_index', [], Response::HTTP_SEE_OTHER);
    }
}
