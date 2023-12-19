<?php

namespace App\Form\admin;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UtilisateurFormType extends AbstractType
{
     public function buildForm(FormBuilderInterface $builder, array $options): void
     {
          $builder
               ->add(
                    'pseudo',
                    null,
                    [
                         'label' => 'Pseudo',
                         'required' => true,
                         'attr' => [
                              'placeholder' => 'Pseudo',
                         ],
                         'constraints' => [
                              new NotBlank([
                                   'message' => 'Veuillez saisir un pseudo',
                              ]),
                         ],
                    ]
               )
               ->add(
                    'first_name',
                    null,
                    [
                         'label' => 'Prénom',
                         'required' => true,
                         'constraints' => [
                              new NotBlank([
                                   'message' => 'Veuillez saisir un prénom',
                              ]),
                         ],
                         'attr' => [
                              'placeholder' => 'Prénom',
                         ],
                    ]
               )
               ->add(
                    'surname',
                    null,
                    [
                         'label' => 'Nom',
                         'required' => true,
                         'constraints' => [
                              new NotBlank([
                                   'message' => 'Veuillez saisir un nom',
                              ]),
                         ],
                         'attr' => [
                              'placeholder' => 'Nom',
                         ],
                    ]
               )
               ->add('date_of_birth', DateType::class, [
                    'label' => 'Date de naissance',
                    'format' => 'ddMMyyyy',
                    'years' => range(date('Y') - 100, date('Y')),
               ])
               ->add(
                    'email',
                    EmailType::class,
                    [
                         'label' => 'Email',
                         'required' => true,
                         'attr' => [
                              'placeholder' => 'Email',
                         ],
                         'constraints' => [
                              new NotBlank([
                                   'message' => 'Veuillez saisir un email',
                              ]),
                              new Regex([
                                   'pattern' => '/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/',
                                   'message' => 'Veuillez saisir un email valide',
                              ])
                         ],
                    ]
               )
               ->add('is_verified', CheckboxType::class, [
                    'required' => false,
                    'label' => 'adresse email vérifiée',
               ])
               ->add('roles', ChoiceType::class, [
                    'choices' => [
                         'Utilisateur' => 'ROLE_USER',
                         'Rédacteur' => 'ROLE_REDACTEUR',
                         'Administrateur' => 'ROLE_ADMIN',
                    ],
               ])
               ->add('Valider', SubmitType::class);

          $builder->get('roles')
               ->addModelTransformer(new CallbackTransformer(
                    function ($rolesArray) {
                         // transform the array to a string
                         return count($rolesArray) ? $rolesArray[0] : null;
                    },
                    function ($rolesString) {
                         // transform the string back to an array
                         return [$rolesString];
                    }
               ));
     }

     public function configureOptions(OptionsResolver $resolver): void
     {
          $resolver->setDefaults([
               'data_class' => User::class,
          ]);
     }
}
