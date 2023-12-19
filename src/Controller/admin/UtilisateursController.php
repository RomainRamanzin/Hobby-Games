<?php

namespace App\Controller\admin;

use App\Entity\User;
use App\Form\admin\UtilisateurFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UtilisateursController extends AbstractController
{
    #[Route('/admin-utilisateurs', name: 'app_admin_utilisateurs')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/utilisateurs/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/admin-utilisateurs/{id}', name: 'app_admin_utilisateurs_show')]
    #[IsGranted('ROLE_ADMIN')]
    public function show(User $user, UserRepository $userRepository): Response
    {
        return $this->render('admin/utilisateurs/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/admin-utilisateurs/{id}/delete', name: 'app_admin_utilisateurs_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(User $user, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($user);
        $entityManager->flush();

        $this->addFlash(
           'success',
           'L\'utilisateur a bien été supprimé.'
        );

        return $this->redirectToRoute('app_admin_utilisateurs');
    }

    #[Route('/admin-utilisateurs/{id}/edit', name: 'app_admin_utilisateurs_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(User $user, UserRepository $userRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $form = $this->createForm(UtilisateurFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
               'success',
               'L\'utilisateur a bien été modifié.'
            );

            return $this->redirectToRoute('app_admin_utilisateurs');
        }

        return $this->render('admin/utilisateurs/edit.html.twig',[
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}
