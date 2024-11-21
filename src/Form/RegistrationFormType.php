<?php

namespace App\Form;

use App\Entity\Ligue1Teams;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use App\Form\RegexTrait;
class RegistrationFormType extends AbstractType
{
    use RegexTrait;
    private const STRONG_PASSWORD = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[#?!@$%^&*\-_]).{8,}$/';

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            // ->add('agreeTerms', CheckboxType::class, [
            //     'mapped' => false,
            //     'constraints' => [
            //         new IsTrue([
            //             'message' => 'You should agree to our terms.',
            //         ]),
            //     ],
            // ])
             ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                        new NotBlank([
                        'message' => 'Please enter a password',
                                     ]),
            // new Length([
            //     'min' => 8,
            //     'minMessage' => 'Your password should be at least {{ limit }} characters',
            //     'max' => 4096,
            // ]),
            new Regex(
                self::STRONG_PASSWORD,
                message: 'Le mot de passe doit contenir au minimum huit caractères, avec au moins une lettre majuscule, une lettre minuscule, un chiffre, et un caractère spécial (#?!@$ %^&*-_).'
            )
        ],
        'invalid_message' => 'Les champs de mot de passe doivent correspondre.',
        'options' => ['attr' => ['class' => 'general__input show_password']],
        'required' => true,
        'first_options'  => ['label' => 'Password *'],
        'second_options' => ['label' => 'Repeat Password *'],
    ])

        ->add('selectedTeam', EntityType::class, [
                'class' => Ligue1Teams::class,
                'choice_label' => 'Name',
                'label' => 'Sélectionnez votre équipe',
                'placeholder' => 'Choisissez une équipe',
                'required' => true,

            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'label' => 'J\'accepte les <a href="/termes/services" target="_blank">termes et conditions</a>',
                'label_html' => true,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
