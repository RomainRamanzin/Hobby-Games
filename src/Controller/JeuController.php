<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JeuController extends AbstractController
{
    #[Route('/jeux', name: 'app_jeux')]
    public function index(GameRepository $gameRepository, Request $request, PaginatorInterface $paginator): Response
    {
        // Récuperer les jeux paginés
        $games = $paginator->paginate(
            $gameRepository->paginatorQuery(),
            $request->query->getInt('page', 1),
            40
        );

        return $this->render('jeu/index.html.twig', [
            'controller_name' => 'JeuController',
            'games' => $games,
        ]);
    }

    #[Route('/jeu/{id}', name: 'app_jeu')]
    public function show(Game $game): Response
    {
        dd($game);

        return $this->render('jeu/show.html.twig', [
            'controller_name' => 'JeuController',
            'game' => $game,
        ]);
    }
}
