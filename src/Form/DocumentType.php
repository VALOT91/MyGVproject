<?php

namespace App\Form;

 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\NotBlank;
 

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image_path',FileType::class,[
                'mapped' => false,
                'label' => false,
                'required' => false,
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
       
        ;
    }

    // public function configureOptions(OptionsResolver $resolver): void
    // {
    //     $resolver->setDefaults([
    //         'data_class' => Document::class,
    //     ]);
    // }
}
