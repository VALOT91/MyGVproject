<?php

namespace App\Controller;

use App\Form\SearchTarifType;
use App\Search\SearchTarif;
use App\Entity\Tarif;
use App\Form\TarifType;
use App\Repository\TarifRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitConditionnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('admin/tarif')]
class TarifController extends AbstractController
{
    #[Route('/', name: 'tarif_index', methods: ['GET'])]
    public function index(Request $request,TarifRepository $tarifRepository): Response
    {
        $search = new SearchTarif();

        $form = $this->createForm(SearchTarifType::class,$search);

        $form->handleRequest($request);

        $tarif = $tarifRepository->findByFilter($search);


        return $this->render('admin/tarif/index.html.twig', [
            'tarifs' => $tarif,'form' => $form->createView()
        ]);
    }

    #[Route('admin/tarif/new', name: 'tarif_new', methods: ['GET', 'POST'])]
    public function new(Request $request,ProduitConditionnementRepository $produitConditionnementRepository,  EntityManagerInterface $entityManager): Response
    {
        $tarif = new Tarif();
        $form = $this->createForm(TarifType::class, $tarif,['stock' => $produitConditionnementRepository->findAll()] );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tarif);
            $entityManager->flush();

            return $this->redirectToRoute('tarif_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/tarif/new.html.twig', [
            'tarif' => $tarif,
            'form' => $form,
        ]);
    }

    #[Route('admin/tarif/{id}', name: 'tarif_show', methods: ['GET'])]
    public function show(Tarif $tarif): Response
    {
        return $this->render('admin/tarif/show.html.twig', [
            'tarif' => $tarif,
        ]);
    }

    #[Route('admin/tarif/{id}/edit', name: 'tarif_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tarif $tarif,ProduitConditionnementRepository $produitConditionnementRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TarifType::class, $tarif,['stock' => $produitConditionnementRepository->findAll()] );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('tarif_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/tarif/edit.html.twig', [
            'tarif' => $tarif,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'tarif_delete', methods: ['POST'])]
    public function delete(Request $request, Tarif $tarif, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tarif->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tarif);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tarif_index', [], Response::HTTP_SEE_OTHER);
    }
}
