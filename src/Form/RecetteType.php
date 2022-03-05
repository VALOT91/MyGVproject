<?php

namespace App\Form;

use App\Entity\Recette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('nom',TextType::class,[
                'required' => false,
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Entrez le nom'
                ],
                
            ])
            ->add('description',TextType::class,[
                'required' => false,
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Entrez la description'
                ],
                
            ])
            ->add('image_path',TextType::class,[
                'required' => false,
                'label' => 'chemin de l\'image',
                'attr' => [
                    'placeholder' => 'Entrez le chemin de l\'image'
                ],
                
            ])
            ->add('product', ChoiceType::class, [
                'label' => 'Produit',
                'choices'  =>  $options['prod'],
                'multiple'=>false,
                'choice_label' => 'designation',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
            'prod'=>null,
        ]);
    }
}
