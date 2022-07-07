<?php

namespace App\Controller;
use App\Form\EditPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountController extends AbstractController
{

    // edition du mot de passe 
    #[Route('encours/modifiermotdepasse', name: 'edit_password_T')]
    #[Route('admin/modifiermotdepasse', name: 'edit_password_A')]
    #[Route('client/modifiermotdepasse', name: 'edit_password_C')]
      public function editPassword(Request $request, EntityManagerInterface $em,UserPasswordHasherInterface $userPasswordHasher)
    {
        // cette annotation générée n'est pas utilisée par le code mais pour la docu
        /** @var User $user */
        $user = $this->getUser();  // fournit les données du connect
           
        $form = $this->createForm(EditPasswordType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode le plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $em->flush();
            // do anything else you need here, like send an email

            $this->addFlash("success","Votre mot de passe a bien été modifié.");
           
            return $this->redirectToRoute("home");
        }

        return $this->render('customer/user/edit_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // affiche le compte du user
    #[Route('encours/account', name: 'show_account_roleT', methods: ['GET'])]
    #[Route('admin/account', name: 'show_account_roleA', methods: ['GET'])]
    #[Route('client/account', name: 'show_account_roleC', methods: ['GET'])]
   
    public function show(): Response
    {
        $user = $this->getUser();
        return $this->render('customer/user/show_account.html.twig', [
            'user' => $user,
        ]);
    }

}