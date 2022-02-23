<?php

namespace App\Form;

use App\Services\HandleImage;
use App\Entity\Conditionnement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ConditionnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
         
            ->add('reference',TextType::class,[
                'required' => false,
                'label' => 'Référence',
                'attr' => [
                    'placeholder' => 'Entrez la référence'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs référence est requis',
                    ]),
                ],
            ])
            ->add('designation',TextType::class,[
                'required' => false,
                'label' => 'Désignation',
                'attr' => [
                    'placeholder' => 'Entrez la désignation'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs désignation est requis',
                    ]),
                ],
            ])
            ->add('poids',IntegerType::class,[
                'required' => false,
                'label' => 'Poids (En grammes)',
                'attr' => [
                    'placeholder' => 'Entrez le poids'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs poids est requis',
                    ]),
                ],
            ])
            ->add('image_path',FileType::class,[
                'mapped' => false,
                'label' => 'Image',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez ajouter une image'
                    ]),
                    new File([
                        'maxSize' => '1m',
                        'maxSizeMessage' => 'Le poids ne peut dépasser 1mo. Votre fichier est trop lourd.'
                    ])
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conditionnement::class,
        ]);
    }
}
