<?php

namespace App\Controller\admin;

use App\Entity\Game;
use App\Entity\Review;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CommentairesController extends AbstractController
{
    #[Route('/admin_commentaires', name: 'app_admin_commentaires')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(ReviewRepository $reviewRepository, Request $request): Response
    {
        $searchForm = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('Pseudo', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Pseudo utilisateur',
                ],
                'required' => false,
            ])
            ->add('Game', EntityType::class, [
                'class' => Game::class,
                'choice_label' => 'name',
                'label' => false,
                'placeholder' => 'Jeu',
                'required' => false,
            ])
            ->add('Submit', SubmitType::class, [
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
            $pseudo = $data['Pseudo'];
            $jeu = $data['Game'];
        } else {
            $pseudo = null;
            $jeu = null;
        }

        $reviews = $reviewRepository->filterQuery($pseudo, $jeu);

        return $this->render('admin/commentaires/index.html.twig', [
            'reviews' => $reviews,
            'searchForm' => $searchForm->createView(),
        ]);
    }

    #[Route('/admin_commentaires/{id}/show', name: 'app_admin_commentaire_show')]
    #[IsGranted('ROLE_ADMIN')]
    public function show(ReviewRepository $reviewRepository, Review $review): Response
    {
        return $this->render('admin/commentaires/show.html.twig', [
            'review' => $review,
        ]);
    }

    #[Route('/admin_commentaires/{id}/delete', name: 'app_admin_commentaire_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Review $review, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($review->getPublication());
        $entityManager->remove($review);
        $entityManager->flush();

        $this->addFlash('success', 'Commentaire supprimé avec succès !');

        return $this->redirectToRoute('app_admin_commentaires');
    }
}
