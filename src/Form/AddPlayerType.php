<?php

namespace App\Form;

use App\Entity\Ligue1Teams;
use App\Entity\Players;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddPlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('birthday', null, [
                'widget' => 'single_text',
            ])
            ->add('position', ChoiceType::class, [
                'choices' => [
                    'Goal' => 'Goal',
                    'Defender' => 'Defender',
                    'Midfielder' => 'Midfielder',
                    'Forward' => 'Forward',
                ],
            ])            ->add('number');

        // add team input only if team assigned is false
        if (!$options['team_assigned']) {
            $builder->add('team', EntityType::class, [
                'class' => Ligue1Teams::class,
                'choice_label' => 'name',
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Players::class,
            'team_assigned' => false,
        ]);

        $resolver->setDefined('team_assigned');
    }
}