<?php

namespace App\Controller;

 
use App\Entity\User;
use App\Form\UserType;
use App\Repository\CommandShopRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

// #[Route('admin/user')]
class UserController extends AbstractController
{
    // affichage des users
    #[Route('admin/user/', name: 'user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
    // affichage du formulaire de creation d'un user
    #[Route('admin/user/new', name: 'user_new', methods: ['GET', 'POST'])]
    public function new(Request $request,UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
            
           
            $user->setPassword(
                $userPasswordHasher->hashPassword(                 // hashage du plain passeword
                      $user,
                        $form->get('plainPassword')->getData()
                    )
                );
            $entityManager->persist($user);
            $entityManager->flush();


            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    // affichage du detail d'un user
    #[Route('admin/user/{id}/show', name: 'user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
          return $this->render('admin/user/show.html.twig', [
          //  return $this->render('/show.html.twig', [
            'user' => $user,
        ]);
    }

    // affichage du formulaire de modification du user
    #[Route('admin/user/{id}/edit', name: 'user_edit', methods: ['GET', 'POST'])]
    #[Route('client/user/{id}/edit', name: 'user_editC', methods: ['GET', 'POST'])]
    #[Route('transit/user/{id}/edit', name: 'user_editT', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $role = $this->getUser()->getRoles()[0]; 

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            if($role=="ROLE_ADMIN")
                return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
            else
                return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER); 
        }

         
        if($role!="ROLE_ADMIN")
            return $this->renderForm('customer/user/edit.html.twig', [
                'user' => $user,
                'form' => $form,
            ]);
        else
            return $this->renderForm('admin/user/edit.html.twig', [
                'user' => $user,
                'form' => $form,
            ]);
    }


    

    // validation du role client
    #[Route('admin/user/{id}/valider', name: 'user_valid', methods: ['GET', 'POST'])]
    public function validate(int $id,UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $entity =  $userRepository->find($id);
        $entity->setRoles(["ROLE_CLIENT"]);
        $entityManager->flush();
    
        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
    // invalidation d'un client
    #[Route('admin/user/{id}/refute', name: 'user_refute', methods: ['GET', 'POST'])]
    public function refute(int $id,UserRepository $userRepository,Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $entity =  $userRepository->find($id);
        $entity->setRoles([""]);
        $entityManager->flush();
    
        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    // passage au role transit
    #[Route('admin/user/{id}/decline', name: 'user_decline', methods: ['GET', 'POST'])]
    public function decline(int $id,UserRepository $userRepository,Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $entity =  $userRepository->find($id);
        $entity->setRoles(["ROLE_TRANSIT"]);
        $entityManager->flush();
    
        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    // suppression d'un user
    #[Route('admin/user/{id}', name: 'user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager,UserRepository $userRepository,CommandShopRepository $CommandShopRepository): Response
    {  
       $commandes = $CommandShopRepository->findBy(array('user_id' => $user->getId() ));

      if(count($commandes) > 0)  
      {
        $this->addFlash("warning","Suppression impossible avec des commandes.");
      
      }
      else
      {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();

        } 
       
      } 
        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }
    
}

