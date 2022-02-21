<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'required' => false,
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'example@example.com'
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
                    'placeholder' => 'Entrez votre non de famille'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs nom est requis',
                    ]),
                ],
            ])
            ->add('prenom',TextType::class,[
                'required' => false,
                'label' => 'prénom',
                'attr' => [
                    'placeholder' => 'Entrez votre prénom'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs nom est requis',
                    ]),
                ],
            ])
            ->add('adresse',TextType::class,[
                'required' => false,
                'label' => 'Adresse',
                'attr' => [
                    'placeholder' => 'Entrez votre adresse'
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
                    'placeholder' => 'Complément ( Batiment, étage . . .'
                ] 
            ])
            ->add('code_postal',IntegerType::class,[
                'required' => false,
                'label' => 'Code postal',
                'attr' => [
                    'placeholder' => 'Entrez votre code postal'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs email est requis',
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
                        'message' => 'Le champs email est requis',
                    ]),
                ],
            ])
            ->add('telephone',TextType::class,[
                'required' => false,
                'label' => 'Téléphone',
                'attr' => [
                    'placeholder' => 'Entrez votre N° de téléphone'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs email est requis',
                    ]),
                ],
            ])
            ->add('Kbis',TextType::class,[
                'required' => false,
                'label' => 'N° Kbis requis pour devenir client',
                'attr' => [
                    'placeholder' => 'Entrez votre kbis'
                ],
            ])
            // ->add('agreeTerms', CheckboxType::class, [
            //     'mapped' => false,
            //     'constraints' => [
            //         new IsTrue([
            //             'message' => 'You should agree to our terms.',
            //         ]),
            //     ],
            // ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Mot de passe',
                'required'=> false,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs mot de passe est requis',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
