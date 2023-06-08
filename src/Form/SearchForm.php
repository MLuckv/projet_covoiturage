<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Ville;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use \Symfony\Component\Form\FormBuilderInterface;
use \Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add('q', TextType::class, [
                'label'=> false,
                'required'=>false,
                'attr' =>[
                    'placeholder' => 'Rechercher'
                ]
                ])

            ->add('ville_depart', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Ville::class,
                'expanded' => false,
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
                'choice_label' => function ($ville) {
                    return $ville->getNomVille();
                },
                'choice_value' => function ($ville) {
                    return $ville->getId();
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('v')
                        ->orderBy('v.nom_ville', 'ASC');
                },
                'group_by' => 'departement.nom_departement',
            ])
                
            
            //rajouter pour plus de champs au form et les rajouter aussi au SearchData
            ->add('ville_arrive', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Ville::class,
                'expanded' => false,
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
                'choice_label' => function ($ville) {
                    return $ville->getNomVille();
                },
                'choice_value' => function ($ville) {
                    return $ville->getId();
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('v')
                        ->orderBy('v.nom_ville', 'ASC');
                },
                'group_by' => 'departement.nom_departement',
            ])

            ->add('dispo', CheckboxType::class, [
                'label' => "est disponnible",
                'required' => false
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=> SearchData::class,
            'method' => 'GET',
            'crsf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}