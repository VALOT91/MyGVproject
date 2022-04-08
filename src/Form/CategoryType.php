<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('gamme', ChoiceType::class, [
            'choices'  => [ 
                'Thés' => "TH",
                'Services pro' => "SE",
                                  
            ],
            'label' => 'Gamme (Thés ou Services pro) ',
            'multiple'=>false
            
        ])
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
            ->add('imagepath1', TextType::class, [
                'label' => 'Image',
            ])
            ->add('imagepath2', TextType::class, [
                'label' => 'Image',
            ])
            ->add('imagepath3', TextType::class, [
                'label' => 'Image',
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
