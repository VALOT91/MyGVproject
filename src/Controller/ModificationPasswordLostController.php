<?php 

namespace App\Controller;

use App\Repository\UserRepository;
use App\Form\ModificationPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ModificationPasswordLostController extends AbstractController
{
    // Page du formulaire de modification du mot de passe
    #[Route('/modification/motdepasse/{token}', name: 'app_password_lost_modification')]
    public function modificationMotDePasse(string $token,Request $request,
    EntityManagerInterface $em, UserRepository $userRepository,UserPasswordHasherInterface $userPasswordHasher)
    {
        // recherche du user par token
        $user = $userRepository->findOneBy([
            'tokenPasswordLost' => $token
        ]);
        // si pas trouvé retour au login
        if(!$user)
        {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(ModificationPasswordType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );

            $em->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render("customer/modification_password.html.twig",[
            'form' => $form->createView()
        ]);
    }
}