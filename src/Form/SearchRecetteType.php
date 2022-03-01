<?php

namespace App\Form;

use App\Entity\Product;
use App\Search\SearchRecette;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchRecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('filterByNom',TextType::class,[
                'label' => 'Filtrer par nom',
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
            'data_class' => SearchRecette::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
