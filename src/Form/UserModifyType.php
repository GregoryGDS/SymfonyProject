<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{DateType, EmailType, PasswordType, RepeatedType, SubmitType, TextType};

class UserModifyType extends AbstractType
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
