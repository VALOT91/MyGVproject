<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Services\HandleImage;
use App\Services\ImageFinder;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 

#[Route('admin/category')]
class CategoryController extends AbstractController
{
    // affichage de la liste des catégories
    #[Route('admin/category', name: 'category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository ): Response
    {
        return $this->render('admin/category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    // affichage du formulaire d'ajout d(une nouvelle catégorie)
    #[Route('admin/category/new', name: 'category_new', methods: ['GET', 'POST'])]
    public function new( Request $request, EntityManagerInterface $entityManager): Response
    {
        $finder = new ImageFinder();
        $filesTab = $finder->GetUploadDirectory();

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // //Recuperer le fichier 
            // /** @var UploadedFile $file */
            $file = $form->get('imagepath3')->getData();
            //Verifier que il y a bien un fichier
            if($file)
            {          
                $category->setImagePath3($file);
            }
            // //Recuperer le fichier 
            // /** @var UploadedFile $file */
            $file = $form->get('imagepath2')->getData();
            //Verifier que il y a bien un fichier
            if($file)
            {          
                $category->setImagepath2($file);
            }

            //  //Recuperer le fichier 
            // /** @var UploadedFile $file */
            $file = $form->get('imagepath1')->getData();
            //Verifier que il y a bien un fichier
            if($file)
            {          
                $category->setImagepath1($file);
            }

            $entityManager->persist($category);
            $entityManager->flush();
           
            return $this->redirectToRoute('category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/category/new.html.twig', [
            'category' => $category,'file'=>$filesTab,
            'form' => $form,
        ]);
    }

    // affichage du détail de la catégorie
    #[Route('/{id}', name: 'category_show', methods: ['GET'])]
    public function show(Category $category): Response
    {     
        return $this->render('admin/category/show.html.twig', [
            'category' => $category,
        ]);
    }

    // affichage du formulaire d'édition
    #[Route('/{id}/edit', name: 'category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Category $category, EntityManagerInterface $entityManager,HandleImage $handleImage): Response
    {
        $oldImage1 = $category->getImagePath1(); //  récupére le path actuel
        $oldImage2 = $category->getImagePath2();
        $oldImage3 = $category->getImagePath3();
        
        $finder = new ImageFinder();
        $filesTab = $finder->GetUploadDirectory();   // récupére les fichiers du répertoire uploads

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
          
        if ($form->isSubmitted() && $form->isValid()) {

           
            //Recuperer le fichier 
            // /** @var UploadedFile $file */
            $file = $form->get('imagepath1')->getData();
            //Verifier que il y a bien un fichier
            if($file)
            {
                $category->setImagepath1( $file);
                
            }
            else
            {
                // si aucune image n'a été sélectionnée, je met l'ancienne
                $category->setImagepath1($oldImage1);

            }

            //Recuperer le fichier 
            // /** @var UploadedFile $file */
            $file = $form->get('imagepath2')->getData();
            //Verifier que il y a bien un fichier
            if($file)
            {
                $category->setImagepath2( $file);
                // $handleImage->edit($file,(string)$oldImage2);
            }
            else
            {
                // si aucune image n'a été sélectionnée, je met l'ancienne
                $category->setImagepath2($oldImage2);
            }

            //Recuperer le fichier 
            // /** @var UploadedFile $file */
            $file = $form->get('imagepath3')->getData();
            //Verifier que il y a bien un fichier
            if($file)
            {
                $category->setImagepath3( $file);
                // $handleImage->edit($file,(string)$oldImage3);
            }
            else
            {
                // si aucune image n'a été sélectionnée, je met l'ancienne
                $category->setImagepath3($oldImage3);
            }

            $entityManager->flush();

            return $this->redirectToRoute('category_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->renderForm('admin/category/edit.html.twig', [
            'category' => $category,'file'=>$filesTab,
            'form' => $form,
        ]);
    }
    // supprime la catégorie
    #[Route('/{id}', name: 'category_delete', methods: ['POST'])]
    public function delete(Request $request, Category $category, EntityManagerInterface $entityManager,ProductRepository $ProductRepository): Response
    {
        $products = $ProductRepository->findBy(array('category_id' => $category->getId() ));

        if(count($products) > 0)  
        {
          $this->addFlash("warning","Suppression impossible car contient des produits.");
        
        }
        else
        {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
        }
    }
        return $this->redirectToRoute('category_index', [], Response::HTTP_SEE_OTHER);
    }
}
