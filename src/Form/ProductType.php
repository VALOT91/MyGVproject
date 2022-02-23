<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options ): void
    {   
        $builder
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
        ->add('description',TextType::class,[
            'required' => false,
            'label' => 'Description',
            'attr' => [
                'placeholder' => 'Entrez la description'
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champs description est requis',
                ]),
            ],
        ])
            
        ->add('accroche',TextType::class,[
            'required' => false,
            'label' => 'Accroche commerciale',
            'attr' => [
                'placeholder' => 'Entrez l\'accroche'
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champs accroche est requis',
                ]),
            ],
        ])
        ->add('composition',TextType::class,[
            'required' => false,
            'label' => 'Composition',
            'attr' => [
                'placeholder' => 'Entrez la composition'
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champs composition est requis',
                ]),
            ],
        ])
        ->add('reco_dose',TextType::class,[
            'required' => false,
            'label' => 'Dosage recommandé',
            'attr' => [
                'placeholder' => 'Entrez le dosage recommandé'
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champs dosage est requis',
                ]),
            ],
        ])

        ->add('reco_duree',TextType::class,[
            'required' => false,
            'label' => 'Durée d\'infusion recommandée',
            'attr' => [
                'placeholder' => 'Entrez la durée d\'infusion recommandée'
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champs durée d\'infusion est requis',
                ]),
            ],
        ])
        ->add('reco_usage',TextType::class,[
            'required' => false,
            'label' => 'Usage',
            'attr' => [
                'placeholder' => 'Entrez  l\'usage'
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champs usage est requis',
                ]),
            ],
        ])
           
        ->add('video_path',TextType::class,[
            'required' => false,
            'label' => 'Chemin de la vidéo',
            'attr' => [
                'placeholder' => 'Entrez le chemin de la vidéo'
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champs chemin de la vidéo est requis',
                ]),
            ],
        ])
        ->add('is_bio',CheckboxType::class,[
            'required' => false,
            'label' => 'Le produit est-il BIO ?',
            'attr' => [
                'placeholder' => 'Le produit est bio'
            ],
             
            
        ])     
        ->add('origine',TextType::class,[
            'required' => false,
            'label' => 'Pays d\'origine',
            'attr' => [
                'placeholder' => 'Entrez le pays d\'origine'
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champs pays d\'origine est requis',
                ]),
            ],
        ])
            
        ->add('category', ChoiceType::class, [
            'label' => 'Categorie',
            'choices'  =>  $options['categ'],
            'multiple'=>false,
            'choice_label' => 'nom',
            
        ])

 
        ->add('role',TextType::class,[  
        'label' => 'Visibilité'
        ])
        
        ->add('resume',TextType::class,[
            'required' => false,
            'label' => 'Résumé du produit',
            'attr' => [
                'placeholder' => 'Entrez le résumé '
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champs résumé  du produit est requis',
                ]),
            ],
        ])
         
        ;
                
   

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'categ' => null,
        ]);
    }
}
