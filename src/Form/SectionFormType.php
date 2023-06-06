<?php

namespace App\Form;

use App\Entity\Section;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Game;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class SectionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', textType::class, [
                'attr' => [
                    'placeholder' => 'Nom de la section',
                ],
                'label' => false,
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['rows' => 6, 'maxlength' => 1000],
                'label' => false,
                'required' => false,
            ])
            ->add('picture', FileType::class, [
                'label' => 'Image',
                'mapped' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Image',
                ],
                'constraints' => [
                    new \Symfony\Component\Validator\Constraints\File([
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Veuillez choisir un fichier de type png, jpeg ou jpg',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Section::class,
        ]);
    }
}
