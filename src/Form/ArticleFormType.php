<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Entity\Game;
use App\Entity\Section;
use App\Form\DataTransformer\GameTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArticleFormType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cover', null, [
                'attr' => [
                    'placeholder' => 'Lien de l\'image d\'illustration',
                ],
                'label' => false,
                'required' => true,
            ])
            ->add('title', textType::class, [
                'attr' => [
                    'placeholder' => 'Titre de l\'article',
                ],
                'label' => false,
                'required' => true,
            ])
            ->add('game', ChoiceType::class, [
                //on passe le tableau des jeux en options
                'choices' => $this->getGameTitles(),
                'placeholder' => 'Sélectionner le jeu',
                'label' => false,
                'required' => false,
            ])
            ->add('sections', CollectionType::class, [
                'entry_type' => SectionFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => false,
            ])
            //sert à récupérer l'id du jeu
            ->get('game')
            //ajout du transformer
            ->addModelTransformer(new GameTransformer($this->entityManager));
    }

    private function getGameTitles(): array
    {
        //récupération de tous les jeux
        $games = $this->entityManager->getRepository(Game::class)->findAll();

        //création d'un tableau avec le nom du jeu en clé et l'id en valeur
        $gameTitles = [];
        //boucle pour remplir le tableau
        foreach ($games as $game) {
            $gameTitles[$game->getName()] = $game->getId();
        }

        return $gameTitles;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
