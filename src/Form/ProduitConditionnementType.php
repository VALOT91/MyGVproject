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
               ->add('image_path', TextType::class, [
                'label' => 'Image',
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
            'file'=>null,
        ]);
    }
}
