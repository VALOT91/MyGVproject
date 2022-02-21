<?php

namespace App\Controller;

use App\Entity\Conditionnement;
use App\Form\ConditionnementType;
use App\Repository\ConditionnementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/conditionnement')]
class ConditionnementController extends AbstractController
{
    #[Route('admin/conditionnement/', name: 'conditionnement_index', methods: ['GET'])]
    public function index(ConditionnementRepository $conditionnementRepository): Response
    {
        return $this->render('admin/conditionnement/index.html.twig', [
            'conditionnements' => $conditionnementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'conditionnement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $conditionnement = new Conditionnement();
        $form = $this->createForm(ConditionnementType::class, $conditionnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($conditionnement);
            $entityManager->flush();

            return $this->redirectToRoute('conditionnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/conditionnement/new.html.twig', [
            'conditionnement' => $conditionnement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'conditionnement_show', methods: ['GET'])]
    public function show(Conditionnement $conditionnement): Response
    {
        return $this->render('admin/conditionnement/show.html.twig', [
            'conditionnement' => $conditionnement,
        ]);
    }

    #[Route('/{id}/edit', name: 'conditionnement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conditionnement $conditionnement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConditionnementType::class, $conditionnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('conditionnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/conditionnement/edit.html.twig', [
            'conditionnement' => $conditionnement,
            'form' => $form,
        ]);
    }

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
