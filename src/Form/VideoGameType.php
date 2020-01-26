<?php

namespace App\Form;

use App\Entity\VideoGame;
use App\Entity\Editor;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\{DateType,SubmitType,TextType};

class VideoGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,[
                'label' => 'Titre : ',
            ])
            ->add('support', TextType::class,[
                'label' => 'Support : ',
            ])
            ->add('description', TextType::class,[
                'label' => 'Description : ',
            ])
            ->add('releaseDate', DateType::class,[
                'years' => range(date('Y'), date('Y')-100),
                'label' => 'Sélectionner la date de parution : ',
            ])
            ->add('gameEditor', EntityType::class,[
                'class' => Editor::class,
                'choice_label' => 'companyName',
                'label' => 'Choisir un éditeur : ',
            ])
            ->add('save', SubmitType::class,[
                'label' => 'Enregistrer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VideoGame::class,
        ]);
    }
}
