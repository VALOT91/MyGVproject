<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Conditionnement;
use App\Entity\ProduitConditionnement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
 

class ProduitConditionnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference',  TextType::class, ['attr' => ['readonly' => true],
            'constraints' => [
                new NotBlank([
                    'message' => 'Reference requise'
                ])
              ]
            ])
            ->add('image_path',FileType::class,[
                'mapped' => false,
                'label' => false,
                'required' => is_null($builder->getData()->getId()),
                'data_class' => null,
                'constraints' => [
                    // new NotBlank([
                    //     'message' => 'Vous devez ajouter une image'
                    // ]),
                    new File([
                        'maxSize' => '1m',
                        'maxSizeMessage' => 'Le poids ne peut dépasser 1mo. Votre fichier est trop lourd.',
                       
                      
                    ])
                ]
            ]) 
            ->add('quantiteStock')
            ->add('produit', ChoiceType::class, [
                'label' => 'Produit',
                'choices'  =>  $options['product'],
                'multiple'=>false,
                'choice_label' =>  function (Product $prd) {
                    return $prd->getReference() . ' - ' .$prd->getDesignation() ;},
                
               
            ])
            ->add('conditionnement', ChoiceType::class, [
                'label' => 'Conditionnement',
                'choices'  =>  $options['conditionnement'],
                'multiple'=>false,
                // 'choice_label' => 'designation',
                'choice_label' =>  function (Conditionnement $prd) {
                    return $prd->getReference() . ' - ' .$prd->getDesignation() ;},
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProduitConditionnement::class,
            'product'=>null,
            'conditionnement'=>null,
        ]);
    }
}
