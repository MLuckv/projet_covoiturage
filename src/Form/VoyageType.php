<?php

namespace App\Form;

use App\Entity\Vehicule;
use App\Entity\Ville;
use App\Entity\Voyage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nb_place', ChoiceType::class, [
                'choices' =>[
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
                'label'=> false
            ])
            ->add('heure_depart', DateTimeType::class, [
                'data' => new \DateTime(),
                'label'=> false
            ])
            ->add('heure_arrive', DateTimeType::class, [
                'data' => new \DateTime(),
                'label'=> false
            ])
            ->add('description', TextareaType::class,[
                "attr" =>[
                    "class" => "form-control"
                ],
                'label'=> false
            ])
            ->add('prix', RangeType::class, [
                'label' => 'Prix',
                'attr' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ])
            ->add('ville_depart', EntityType::class, [
                'class' => Ville::class,
                'label' => false
            ])
            ->add('ville_arrive', EntityType::class, [
                'class' => Ville::class,
                'label' => false
            ])
            ->add('vehicule', EntityType::class, [
                'class' => Vehicule::class,
                'label' => false
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
            'data_class' => Voyage::class,
        ]);
    }
}
