<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
         ->add('nom', TextType::class, [
                'label' => 'Catégorie',
                'required'=> false,
                'attr' => [ 'placeholder' => 'Entrez la catégorie. . .'] ,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs catégorie est requis',
                    ]),
                ],
            ]) 
            ->add('description', TextType::class, [
                'label' => 'Description',
                'required'=> false,
                'attr' => [ 'placeholder' => 'Entrez la description. . .'] ,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs description est requis',
                    ]),
                ],
            ])
            ->add('imagepath1',FileType::class,[
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
            ->add('imagepath2',FileType::class,[
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
            ->add('imagepath3',FileType::class,[
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
            'data_class' => Category::class,
        ]);
    }
}
