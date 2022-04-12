<?php

namespace App\Form;

use App\Entity\Articles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\NotBlank;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class,[
                'required' => false,
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'Entrez le titre'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs titre est requis',
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
            ->add('contenu',TextType::class,[
                'required' => false,
                'label' => 'Contenu',
                'attr' => [
                    'placeholder' => 'Entrez le contenu'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs date est requis',
                    ]),
                ],
                
            ])
            ->add('dateFin',DateType::class,[
                'required' => false,
                'label' => 'Date de fin',
                'attr' => [
                    'placeholder' => 'Entrez la date de fin'
                ],
                
            ])
            ->add('img',TextType::class,[
                'required' => false,
                'label' => 'Image',
                'attr' => [
                    'placeholder' => 'Entrez le chemin de l\'image'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs image est requis',
                    ]),
                ],
                
            ])
            ->add('categorie',TextType::class,[
                'required' => false,
                'label' => 'Catégorie',
                'attr' => [
                    'placeholder' => 'Entrez la catégorie'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champs date est requis',
                    ]),
                ],
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
