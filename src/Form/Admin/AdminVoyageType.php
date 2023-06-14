<?php

namespace App\Form\Admin;

use App\Entity\Voyage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminVoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nb_place')
            ->add('heure_depart')
            ->add('heure_arrive')
            ->add('created_at')
            ->add('description')
            ->add('slug')
            ->add('prix')
            ->add('ville_depart')
            ->add('ville_arrive')
            ->add('vehicule')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }
}
