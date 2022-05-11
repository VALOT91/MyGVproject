<?php

namespace App\Controller;

use App\Form\PasswordLostType;
use App\Repository\UserRepository;
use App\Services\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class LostPasswordController extends AbstractController
{
    // Affiche le formulaire de saisie de l'identifiant (email)
    #[Route('/lost/password', name: 'app_lost_password')]
    public function index(TokenGeneratorInterface $tokenGenerator,
    UserRepository $userRepository,
    EntityManagerInterface $em,Request $request,MailerService $mailer): Response
    {
        $form = $this->createForm(PasswordLostType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {    
            $email = $form->get('email')->getData();

            // recherche le mail du user
            $user = $userRepository->findOneBy([
                'email' => $email
            ]);
              
            // si non trouvé retour au login
            if(!$user)
            {
                return $this->redirectToRoute('app_login');
            }

            // géneration d'un token pour la sécurité qui est enregistré en BDD
            $token = $tokenGenerator->generateToken() . uniqid();

            $user->setTokenPasswordLost($token);

            $em->flush();

            $mailer->sendLostPasswordEmail($user);   // envoi du mail 

            $this->addFlash('success','Un email avec un lien de modif de mot de passe vous a été envoyé.');

            return $this->redirectToRoute('app_login');

        }

        return $this->render('customer/lost_password/index.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
