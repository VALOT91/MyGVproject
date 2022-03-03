<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints\NotBlank;
use App\Entity\DeliveryAddress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class DeliveryAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('raison_soc',TextType::class,[
                'label' => 'Raison sociale',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez la raison sociale'
                    ])
                ]
            ])
            ->add('country',TextType::class,[
                'label' => 'Pays de livraison',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez le pays'
                    ])
                ]
            ])
            ->add('street',TextType::class,[
                'label' => 'Adresse',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez l\'adresse'
                    ])
                ]
            ])
            ->add('complement',TextType::class,[
                'label' => 'Complément d\'adresse',
                'required' => false
            ])
            ->add('postalCode',TextType::class,[
                'label' => 'Code postal',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez le code postal'
                    ])
                ]
            ])
            ->add('city',TextType::class,[
                'label' => 'Ville de livraison',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez la ville'
                    ])
                ]
            ])
            ->add('commentary',TextType::class,[
                'label' => 'Consignes au livreur)',
                'required' => false
            ])
            ->add('CGV',CheckboxType::class,[
                'mapped' => false,
                'required' => false,
                'label' => 'Je reconnais avoir pris connaissance des CGV',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Cochez la case CGV',
                    ]),
                ],
            ])
                 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DeliveryAddress::class,
        ]);
    }
}
