<?php

namespace App\Form;

use App\Entity\ProduitConditionnement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
 
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProduitConditionnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('image_path')
            ->add('quantiteStock')
            // ->add('conditionnement')
            // ->add('produit')

            ->add('produit', ChoiceType::class, [
                'label' => 'Produit',
                'choices'  =>  $options['product'],
                'multiple'=>false,
                'choice_label' => 'designation',
            ])
            ->add('conditionnement', ChoiceType::class, [
                'label' => 'Conditionnement',
                'choices'  =>  $options['conditionnement'],
                'multiple'=>false,
                'choice_label' => 'designation',
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
