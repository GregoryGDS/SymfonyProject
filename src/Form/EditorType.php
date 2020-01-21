<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\{SubmitType, TextType};
use App\Entity\Editor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyName', TextType::class,[
                'label' => 'Nom de l\'entreprise : ',
            ])
            ->add('nationality', TextType::class,[
                'label' => 'Nationalité : ',
            ])
            ->add('save', SubmitType::class,[
                'label' => 'Enregistrer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Editor::class,
        ]);
    }
}
