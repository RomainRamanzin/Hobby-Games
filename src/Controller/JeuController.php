<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Platform;
use App\Entity\Type;
use App\Repository\ArticleRepository;
use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JeuController extends AbstractController
{
    #[Route('/jeux', name: 'app_jeux')]
    public function index(GameRepository $gameRepository, Request $request, PaginatorInterface $paginator): Response
    {
        //Création du formulaire de recherche
        $formSearch = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('search', TextType::class, [
                'required' => false,
            ])
            ->add('type', EntityType::class, [
                'multiple' => false,
                'class' => Type::class,
                'choice_label' => 'name',
                'placeholder' => 'Type de jeu',
                'required' => false,
            ])
            ->add('platform', EntityType::class, [
                'multiple' => false,
                'class' => Platform::class,
                'choice_label' => 'name',
                'placeholder' => 'Plateforme',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ])
            ->getForm();


        // Traitement du formulaire
        $formSearch->handleRequest($request);

        if ($formSearch->isSubmitted() && $formSearch->isValid()) {
            
            $data = $formSearch->getData();
            // dd($data['search']);

            $search = $data['search'];
            $type = $data['type'];
            $platform = $data['platform'];

        } else {
            // Initialisation des variables de recherche
            $search = null;
            $type = null;
            $platform = null;
        }

        // Récuperer les jeux paginés
        $games = $paginator->paginate(
            $gameRepository->filterQuery($search, $type, $platform),
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('jeu/index.html.twig', [
            'controller_name' => 'JeuController',
            'games' => $games,
            'formSearch' => $formSearch->createView(),
        ]);
    }

    #[Route('/jeu/{id}', name: 'app_jeu')]
    public function show(Game $game, ArticleRepository $articleRepository): Response
    {
        // Récupérer les 4 derniers articles du jeu ou random si il n'y en a pas 4
        $nbArticlesToDisplay = 4;
        $gameArticles = $game->getArticles();
        $articles = new ArrayCollection();

        // Si il n'y a pas assez d'articles, on complète avec des articles random
        if (count($gameArticles) < $nbArticlesToDisplay) {

            $nbArticlesRandom = $nbArticlesToDisplay - count($gameArticles);
            $lastArticles = $articleRepository->findLastArticles($nbArticlesRandom);
            
            foreach ($gameArticles as $article) {
                $articles->add($article);
            }

            foreach ($lastArticles as $article) {
                $articles->add($article);
            }

        } else {
            $articles = $gameArticles->slice(0, $nbArticlesToDisplay);
        }

        return $this->render('jeu/show.html.twig', [
            'game' => $game,
            'articles' => $articles,
        ]);
    }
}
