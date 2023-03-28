<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Publication;
use App\Entity\Review;
use App\Repository\PublicationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvisController extends AbstractController
{
    #[Route('/avis/{id}', name: 'app_avis')]
    public function index(Game $game, PublicationRepository $publicationRepository): Response
    {

        // current user publication
        $user = $this->getUser();
        $authUserPublication = $publicationRepository->findOneBy([
            'user' => $user,
            'game' => $game
        ]);

        $publications = $game->getPublications();

        return $this->render('avis/index.html.twig', [
            'publications' => $publications,
            'game' => $game,
            'authUserPublication' => $authUserPublication
        ]);
    }


    #[Route('/avis/{id}/add', name: 'app_avis_add')]
    public function add(Game $game, Request $request, EntityManagerInterface $entityManager, PublicationRepository $publicationRepository): Response
    {
        //récupérer l'utilisateur connecté
        // $user = $this->getUser();
        // if (!$user) {
        //     return $this->redirectToRoute('app_login');
        // }

        // //vérifier si l'utilisateur a deja laisser une publication sur ce jeu
        // $publication = $publicationRepository->findOneBy([
        //     'user' => $user,
        //     'game' => $game
        // ]);

        // if ($publication) {
        //     $review = $publication->getReview();
        // }
        // else {
        //     $review = new Review();
        // }

        //todo: Verouiller avec l'utilisateur connecté
        
        $review = new Review();

        $formReview = $this->createFormBuilder($review)
            ->add('rate', ChoiceType::class, [
                'choices' => [
                    '--' => '',
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
            ])
            ->add('title', TypeTextType::class)
            ->add('content', TextareaType::class)
            ->add('submit', SubmitType::class)
            ->getForm();

        //traitement du formulaire
        $formReview->handleRequest($request);

        if ($formReview->isSubmitted() && $formReview->isValid()) {

            //récupérer la date du jour
            $date = new \DateTime();

            $review->setPublicationDate($date);

            //créer une nouvelle publication
            $publication = new Publication();

            //ajouter les données du formulaire dans la publication
            $publication->setUser($user);
            $publication->setReview($review);
            $publication->setGame($game);

            //enregistrer en base de données

            $entityManager->persist($publication);
            $entityManager->flush();

            //rediriger vers la page de l'avis
            return $this->redirectToRoute('app_avis', ['id' => $game->getId()]);
        }


        return $this->render('avis/new-avis.html.twig', [
            'game' => $game,
            'formReview' => $formReview->createView()
        ]);
    }
}
