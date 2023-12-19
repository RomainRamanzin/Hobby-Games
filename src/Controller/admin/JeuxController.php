<?php

namespace App\Controller\admin;

use App\Entity\Game;
use App\Entity\GamePicture;
use App\Entity\Platform;
use App\Entity\Type;
use App\Form\admin\AddGamePictureFormType;
use App\Form\admin\JeuFormType;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class JeuxController extends AbstractController
{
    #[Route('/admin-jeux', name: 'app_admin_jeux')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(GameRepository $gameRepository, Request $request): Response
    {
        $searchForm = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('Nom', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Rechercher par nom',
                ],
                'required' => false,
            ])
            ->add('Plateforme', EntityType::class, [
                'class' => Platform::class,
                'choice_label' => 'name',
                'label' => false,
                'placeholder' => 'Plateforme',
                'required' => false,
            ])
            ->add('Genre', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'name',
                'label' => false,
                'placeholder' => 'Genre',
                'required' => false,
            ])
            ->add('rechercher', SubmitType::class, [
                'label' => 'Rechercher',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ])
            ->getForm();
        
        $searchForm->handleRequest($request);

       // dd($searchForm);
        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $data = $searchForm->getData();
            $nom = $data['Nom'];
            $plateforme = $data['Plateforme'];
            $genre = $data['Genre'];
        } else {
            $nom = null;
            $plateforme = null;
            $genre = null;
        }

        $games = $gameRepository->filterQuery($nom, $genre , $plateforme);

        return $this->render('admin/jeux/index.html.twig', [
            'games' => $games,
            'searchForm' => $searchForm->createView(),
        ]);
    }

    #[Route('/admin-jeux/{id}/show', name: 'app_admin_jeux_show')]
    #[IsGranted('ROLE_ADMIN')]
    public function show(Game $game, GameRepository $gameRepository): Response
    {
        return $this->render('admin/jeux/show.html.twig', [
            'game' => $game,
        ]);
    }

    #[Route('/admin-jeux/{id}/edit', name: 'app_admin_jeux_edit')]
    #[Route('/admin-jeux/add', name: 'app_admin_jeux_add')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Game $game = null, GameRepository $gameRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$game) {
            $game = new Game();
        }

        $form = $this->createForm(JeuFormType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $game = $form->getData();

            $pictureFile = $form->get('poster')->getData();

            if($pictureFile){
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                //$safeFilename = $slugger->slug($originalFilename);
                $newFilename = uniqid().'.'.$pictureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $pictureFile->move(
                        'game_poster',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $game->setPoster('/game_poster/'.$newFilename);
            }

            $entityManager->persist($game);
            $entityManager->flush();

            $this->addFlash('success', 'Le jeu a bien été enregistré.');

            return $this->redirectToRoute('app_admin_jeux');
        }

        return $this->render('admin/jeux/edit.html.twig', [
            'game' => $game,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin-jeux/{id}/delete', name: 'app_admin_jeux_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Game $game, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($game);
        $entityManager->flush();

        $this->addFlash('success', 'Le jeu a bien été supprimé.');

        return $this->redirectToRoute('app_admin_jeux');
    }

    #[Route('/admin-jeux/delete-pic/{id}', name: 'app_admin_jeux_delete_picture')]
    #[IsGranted('ROLE_ADMIN')]
    public function deletePicture(GamePicture $gamePicture, EntityManagerInterface $entityManager): Response
    {
        $game = $gamePicture->getGame();

        $entityManager->remove($gamePicture);
        $entityManager->flush();

        $this->addFlash('success', 'La photo a bien été supprimée.');

        return $this->redirectToRoute('app_admin_jeux_show', ['id' => $game->getId()]);
    }

    #[Route('/admin-jeux/{id}/add-pic', name: 'app_admin_jeux_add_picture')]
    #[IsGranted('ROLE_ADMIN')]
    public function addPicture(Game $game, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $gamePicture = new GamePicture();
        $gamePicture->setGame($game);

        $form = $this->createForm(AddGamePictureFormType::class, $gamePicture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $pictureFile = $form->get('picture')->getData();

            if ($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pictureFile->guessExtension();

                try {
                    $pictureFile->move(
                        'game_pictures',
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                $gamePicture->setPicture('/game_pictures/'.$newFilename);
            }

            $entityManager->persist($gamePicture);
            $entityManager->flush();

            $this->addFlash('success', 'La photo a bien été ajoutée.');

            return $this->redirectToRoute('app_admin_jeux_show', ['id' => $game->getId()]);
        }

        return $this->render('admin/jeux/add-picture.html.twig', [
            'game' => $game,
            'form' => $form->createView(),
        ]);
    }
}
