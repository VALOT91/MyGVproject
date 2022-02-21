<?php

namespace App\Form;

use App\Entity\Tarif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TarifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('prix_unitaire', IntegerType::class, [
            'label' => 'Prix unitaire',
            'required'=> false,
            'attr' => [ 'placeholder' => 'Entrez le prix unitaire. . .'] ,
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champs prix est requis',
                ]),
            ],
        ])
        ->add('type_prix', ChoiceType::class, [
            'choices'  => [ 
                'Prix public' => "PRIX_PUBLIC",
                'Prix pro' => "PRIX_PRO",
                                  
            ],
            'label' => 'Type de prix (public ou pro) ',
            'multiple'=>false
            
        ])
        ->add('produit_conditionnement', ChoiceType::class, [
            'label' => 'Article en stock',
            'choices'  =>  $options['stock'],
            'multiple'=>false,
            'choice_label' => 'reference',
         ])   
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tarif::class,
            'stock' => null,
        ]);
    }
}
