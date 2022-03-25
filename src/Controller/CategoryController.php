<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Services\HandleImage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\ImageFinder;
 

#[Route('admin/category')]
class CategoryController extends AbstractController
{
    #[Route('admin/category', name: 'category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository ): Response
    {
        
       

        return $this->render('admin/category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

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

    #[Route('/{id}', name: 'category_show', methods: ['GET'])]
    public function show(Category $category): Response
    {     
        return $this->render('admin/category/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/{id}/edit', name: 'category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Category $category, EntityManagerInterface $entityManager,HandleImage $handleImage): Response
    {
        $oldImage1 = $category->getImagePath1();
        $oldImage2 = $category->getImagePath2();
        $oldImage3 = $category->getImagePath3();
        
        $finder = new ImageFinder();
        $filesTab = $finder->GetUploadDirectory();

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
                // $handleImage->edit($file,(string)$oldImage1);
            }
            else
            {
               
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

    #[Route('/{id}', name: 'category_delete', methods: ['POST'])]
    public function delete(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_index', [], Response::HTTP_SEE_OTHER);
    }
}
