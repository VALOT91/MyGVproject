<?php

namespace App\Controller;

use App\Services\HandleImage;
use App\Entity\Conditionnement;
use App\Form\ConditionnementType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ConditionnementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Services\ImageFinder;

#[Route('admin/conditionnement')]
class ConditionnementController extends AbstractController
{
    // affiche la liste des conditionnements
    #[Route('admin/conditionnement/', name: 'conditionnement_index', methods: ['GET'])]
    public function index(ConditionnementRepository $conditionnementRepository): Response
    {
        // renvoie les conditionnements 
        return $this->render('admin/conditionnement/index.html.twig', [
            'conditionnements' => $conditionnementRepository->findAll(),
        ]);
    }

    // affiche le formulaire de création d'un nouveau conditonnement
    #[Route('/new', name: 'conditionnement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $finder = new ImageFinder();
        $filesTab = $finder->GetUploadDirectory();   // charge les fichiers du répertoire uploads

        $conditionnement = new Conditionnement();
        $form = $this->createForm(ConditionnementType::class, $conditionnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        

            $entityManager->persist($conditionnement);
            $entityManager->flush();

            return $this->redirectToRoute('conditionnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/conditionnement/new.html.twig', [
            'conditionnement' => $conditionnement,'file'=>$filesTab,
            'form' => $form,
        ]);
    }

    // affiche le detail d'un conditionnement
    #[Route('/{id}', name: 'conditionnement_show', methods: ['GET'])]
    public function show(Conditionnement $conditionnement): Response
    {
        return $this->render('admin/conditionnement/show.html.twig', [
            'conditionnement' => $conditionnement,
        ]);
    }

    // affiche le formulaire d'édition d'un conditonnement
    #[Route('/{id}/edit', name: 'conditionnement_edit', methods: ['GET', 'POST'])]
    public function edit( Request $request, Conditionnement $conditionnement, EntityManagerInterface $entityManager): Response
    {
        $finder = new ImageFinder();
        $filesTab = $finder->GetUploadDirectory(); // charge les fichiers du répertoire uploads

        $oldImage = $conditionnement->getImagePath();
        $form = $this->createForm(ConditionnementType::class, $conditionnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // //Recuperer le fichier 
            // /** @var UploadedFile $file */
             $file = $form->get('image_path')->getData();
            //Verifier que il y a bien un fichier
            if($file)
            {
               // $handleImage->edit($file,$conditionnement,$oldImage);
               $conditionnement->setImagepath( $file);
              // $handleImage->edit($file,(string)$oldImage);
            }
            else
            {    // si aucune image n'a été sélectionnée, je met l'ancienne
                $conditionnement->setImagepath($oldImage);
            }


            $entityManager->flush();

            return $this->redirectToRoute('conditionnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/conditionnement/edit.html.twig', [
            'conditionnement' => $conditionnement,'file'=>$filesTab,
            'form' => $form,
        ]);
    }

    // supprime un conditionnement
    #[Route('/{id}', name: 'conditionnement_delete', methods: ['POST'])]
    public function delete(Request $request, Conditionnement $conditionnement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conditionnement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($conditionnement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('conditionnement_index', [], Response::HTTP_SEE_OTHER);
    }
}
