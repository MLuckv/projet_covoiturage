<?php

namespace App\Form;

use App\Entity\Message;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                "attr" =>[
                    "class" => "form-control"
                ]
            ])
            ->add('msg', TextareaType::class, [
                "attr" =>[
                    "class" => "form-control"
                ]
            ])
            ->add('recipient', EntityType::class, [
                "class" => User::class,
                "choice_label" => "email",
                "attr" =>[
                    "class" => "form-control"
                ]
            ])
            ->add('evoyer', SubmitType::class, [
                "attr" =>[
                    "class" => "btn btn-primary"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
