<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', null, 
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
            ->add('first_name', null,
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
            ->add('surname', null, 
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
            ->add('email', EmailType::class, 
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
            ->add('avatar', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Avatar',
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Veuillez saisir un fichier valide',
                    ]),
                ],

            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
