<?php

namespace App\Form;

use App\Entity\Ligue1Teams;
use App\Entity\Players;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('LastName')
        ->add('birthday', DateType::class, [
            'label' => 'Date de naissance',
            'widget' => 'single_text', // Pour un champ de date en un seul champ
            'html5' => true, // Pour afficher un sélecteur de date dans les navigateurs supportés
            'placeholder' => 'Sélectionnez une date',
        ])

            ->add('position', ChoiceType::class, [
            'label' => 'Poste',
            'choices' => [
                'Goal' => 'Goal',
                'Defender' => 'Defender',
                'Midfielder' => 'Midfielder',
                'Forward' => 'Forward',
            ],
            'placeholder' => 'Sélectionnez un poste',
        ])

            ->add('number')
            ->add('team', EntityType::class, [
                'class' => Ligue1Teams::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Players::class,
        ]);
    }
}
