<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
            ->add('ville', EntityType::class,[
                'label' => false,
                'required' => false,
                'class' => Ville::class,
                'expanded' => true,
                'multiple' => true
            ]) //rajouter pour plus de champs au form et les rajouter aussi au SearchData
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