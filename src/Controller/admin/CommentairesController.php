<?php

namespace App\Controller\admin;

use App\Entity\Review;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CommentairesController extends AbstractController
{
    #[Route('/admin_commentaires', name: 'app_admin_commentaires')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(ReviewRepository $reviewRepository): Response
    {
        return $this->render('admin/commentaires/index.html.twig', [
            'reviews' => $reviewRepository->findAll(),
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
