<?php

namespace App\Form;

use App\Entity\Conducteur;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConducteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('age', IntegerType::class, [
                'label' => false,
            ])
            ->add('ville_user', EntityType::class, [
                'label' => false,
                'class' => Ville::class,
                'choice_label' => 'nom_ville',
            ])
            ->add('submit', SubmitType::class, [
                "attr" =>[
                    "class" => "btn btn-primary"
                ]
            ])  
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conducteur::class,
        ]);
    }
}
