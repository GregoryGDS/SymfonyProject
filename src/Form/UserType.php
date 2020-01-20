<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\{DateType, EmailType, PasswordType, RepeatedType, SubmitType, TextType};
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class,[
                'label' => 'Prénom : ',
            ])
            ->add('lastName', TextType::class,[
                'label' => 'Nom : ',
            ])
            ->add('email', EmailType::class,[
                'label' => 'Email : ',
            ])
            ->add('birthDate', DateType::class, [
                'years' => range(date('Y'), date('Y')-100),
                'label' => 'Sélectionner votre date de naissance : ',
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe : '],
                'second_options' => ['label' => "Répéter le mot de passe : "],
            ])
            ->add('save', SubmitType::class,[
                'label' => 'Enregistrer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
