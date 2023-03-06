<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Platform;
use App\Entity\Type;
use App\Repository\GameRepository;
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
            ->add('search', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Rechercher un jeu'
                ],
                'required' => false,
            ])
            ->add('type', EntityType::class, [
                'multiple' => false,
                'class' => Type::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-select'
                ],
                'placeholder' => 'Type de jeu',
                'required' => false,
            ])
            ->add('platform', EntityType::class, [
                'multiple' => false,
                'class' => Platform::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-select'
                ],
                'placeholder' => 'Plateforme',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
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

            $filteredQuery = $gameRepository->filterQuery($search, $type, $platform);
        }
        else{
            $search = null;
            $type = null;
            $platform = null;
        }

        $games = $gameRepository->filterQuery($search, $type, $platform);

        // // Récuperer les jeux paginés
        // $games = $paginator->paginate(
        //     $gameRepository->paginatorQuery(),
        //     $request->query->getInt('page', 1),
        //     40
        // );

        return $this->render('jeu/index.html.twig', [
            'controller_name' => 'JeuController',
            'games' => $games,
            'formSearch' => $formSearch->createView(),
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
