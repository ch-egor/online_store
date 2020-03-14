<?php

namespace App\Form;

use App\Entity\User;
use App\Service\SecurityService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', Type\EmailType::class)
            ->add('roles', Type\ChoiceType::class, [
                'choices' => array_flip(SecurityService::LABELS_ROLE),
                'multiple' => true,
            ])
            ->add('password', Type\PasswordType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
