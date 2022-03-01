<?php

namespace App\Form;

use App\Entity\Product;
use App\Search\SearchProductConditionnement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchProductConditionnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('filterByReference',TextType::class,[
                'label' => 'Filtrer par référence',
                'required' => false,
            ])
            ->add('filterByProduct',EntityType::class,[
                'label' => 'Filtrer par produit',
                'placeholder' => '-- Choisir --',
                'class' => Product::class,
                'required' => false,
                'choice_label' => 'designation'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchProductConditionnement::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
