<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ["label" =>"Nom", "required" =>true])
            ->add('firstName', TextType::class, ["label" =>"Prénom"])
            ->add('phone', TextType::class, ["label" =>"Téléphone","required" =>true])
            ->add('location',TextType::class, ["label" =>"Localisation","required" =>true])
            ->add('areaCode',TextType::class, ["label" =>"Code Postal","required" =>true])
            ->add('email',TextType::class, ["label" =>"email","required" =>true])
            ->add('password')
            ->add('submit', SubmitType::class, ["label" => "Valider", "attr" => ["class" => "btn btn-success"]])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

}
