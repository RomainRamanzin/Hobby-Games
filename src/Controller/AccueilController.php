<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(GameRepository $gameRepository, ArticleRepository $articleRepository): Response
    {
        //les dernières sorties
        $lastGames = $gameRepository->findLastGames();

        //les sorties à venir
        $comingGames = $gameRepository->findUpcomingGames();

        //les dernières actualités
        $lastActu = $articleRepository->findLastArticles(6);

        //top actu
        $topActus = $articleRepository->findLastArticles(3);

        return $this->render('accueil/index.html.twig', [
            'lastGames' => $lastGames,
            'comingGames' => $comingGames,
            'lastActu' => $lastActu,
            'topActus' => $topActus,
        ]);
    }
}
