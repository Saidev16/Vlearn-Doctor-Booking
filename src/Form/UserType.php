<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            // ->add('roles')
            // ->add('password')
            ->add('Adress')
            ->add('phone_number')
            ->add('education')
            ->add('description')
            ->add('gender', ChoiceType::class , [
                'choices'=> [
                    'Male'=>'Male',
                    'Female'=> 'Female'
                ]
            ])
            ->add('email', TextType::class, [
                'attr'=>['disabled'=>'disabled']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
