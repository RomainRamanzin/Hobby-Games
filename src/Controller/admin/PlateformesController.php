<?php

namespace App\Controller\admin;

use App\Entity\Platform;
use App\Form\admin\PlateformeFormType as AdminPlateformeFormType;
use App\Repository\PlatformRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class PlateformesController extends AbstractController
{
    #[Route('/admin-plateformes', name: 'app_admin_plateformes')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(PlatformRepository $platformRepository): Response
    {
        return $this->render('admin/plateformes/index.html.twig', [
            'platforms' => $platformRepository->findAll(),
        ]);
    }

    #[Route('/admin-plateforme/{id}/show', name: 'app_admin_plateforme_show')]
    #[IsGranted('ROLE_ADMIN')]
    public function show(Platform $platform): Response
    {
        return $this->render('admin/plateformes/show.html.twig', [
            'platform' => $platform,
        ]);
    }

    #[Route('/admin-plateforme/{id}/delete', name: 'app_admin_plateforme_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Platform $platform, PlatformRepository $platformRepository, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($platform);
        $entityManager->flush();

        $this->addFlash('success', 'La plateforme a bien été supprimée');

        return $this->redirectToRoute('app_admin_plateformes');
    }

    #[Route('/admin-plateforme/{id}/edit', name: 'app_admin_plateforme_edit')]
    #[Route('/admin-plateforme/add', name: 'app_admin_plateforme_add')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Platform $platform = null, PlatformRepository $platformRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        if (!$platform) {
            $platform = new Platform();
        }

        $form = $this->createForm(AdminPlateformeFormType ::class, $platform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($platform);
            $entityManager->flush();

            $this->addFlash('success', 'La plateforme a bien été modifiée / ajoutée');

            return $this->redirectToRoute('app_admin_plateformes');
        }

        return $this->render('admin/plateformes/edit.html.twig', [
            'form' => $form->createView(),
            'platform' => $platform,
        ]);
    }

}
