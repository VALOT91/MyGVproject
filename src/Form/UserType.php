<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\IsTrue;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
         
        $builder
            
            ->add('email',EmailType::class,[
                'required' => false,
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Entrez votre adresse email'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs email est requis',
                    ]),
                ],
            ])
            ->add('nom',TextType::class,[
                'required' => false,
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Entrez votre nom'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs nom est requis',
                    ]),
                ],
            ])
            ->add('prenom',TextType::class,[
                'required' => false,
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Entrez votre prénom'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs prénom est requis',
                    ]),
                ],
            ])
            ->add('adresse',TextType::class,[
                'required' => false,
                'label' => 'Adresse',
                'attr' => [
                    'placeholder' => 'Entrez Votre adresse'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs adresse est requis',
                    ]),
                ],
            ])
            ->add('complement',TextType::class,[
                'required' => false,
                'label' => 'Complement',
                'attr' => [
                    'placeholder' => 'Si nécessaire Bat, étage ...'
                ]
            ])
           
            ->add('roles', ChoiceType::class, [
                'choices'  => [ 
                    'Utilisateur' => "ROLE_TRANSIT",
                    'Client' => "ROLE_CLIENT",
                    'Administrateur' => "ROLE_ADMIN",                   
                ],
                'multiple'=>false
                
            ])
            
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Mot de passe',
                'required'=> false,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password', 'placeholder' => 'Entrez votre mot de passe'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs mot de passe est requis',
                    ]),
                ],
            ])
            ->add('code_postal',TextType::class,[
                'required' => false,
                'label' => 'Code postal',
                'attr' => [
                    'placeholder' => 'Entrez votre code postal'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs code postal est requis',
                    ]),
                ],
            ])
            ->add('ville',TextType::class,[
                'required' => false,
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Entrez votre ville'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs ville est requis',
                    ]),
                ],
            ])
            ->add('telephone',TextType::class,[
                'required' => false,
                'label' => 'Téléphone',
                'attr' => [
                    'placeholder' => 'Entrez votre Téléphone'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs téléphone est requis',
                    ]),
                ],
            ])
         
            
            ->add('points_fidelite')
            ->add('pays')
            ->add('rang_fidelite')
            ->add('kbis',TextType::class,[
                'required' => false,
                'label' => 'N°kbis',
                'attr' => [
                    'placeholder' => 'Entrez votre Kbis '
                ]
            ])
        ;

              // Data transformer
        $builder->get('roles')
        ->addModelTransformer(new CallbackTransformer(
            function ($rolesArray) {
                 // transform the array to a string
                 return count($rolesArray)? $rolesArray[0]: null;
            },
            function ($rolesString) {
                 // transform the string back to an array
                 return [$rolesString];
            }
    ));




    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
