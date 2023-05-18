<?php

namespace App\Controller\admin;

use App\Entity\Editor;
use App\Entity\User;
use App\Form\admin\EditeurFormType;
use App\Repository\EditorRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditeursController extends AbstractController
{
    #[Route('/admin-editeurs', name: 'app_admin_editeurs')]
    #[isGranted('ROLE_ADMIN')]
    public function index(EditorRepository $editorRepository, Request $request): Response
    {
        $searchForm = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('Nom', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Rechercher par nom',
                ],
            ])
            ->add('rechercher', SubmitType::class, [
                'label' => 'Rechercher',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ])
            ->getForm();
        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $data = $searchForm->getData();
            $nom = $data['Nom'];
        } else {
            $nom = null;
        }

        $editors = $editorRepository->search($nom);

        return $this->render('admin/editeurs/index.html.twig', [
            'editors' => $editors,
            'searchForm' => $searchForm->createView(),
        ]);
    }

    #[Route('/admin-editeurs/{id}/show', name: 'app_admin_editeur_show')]
    #[IsGranted('ROLE_ADMIN')]
    public function show(Editor $editor): Response
    {
        return $this->render('admin/editeurs/show.html.twig', [
            'editor' => $editor,
        ]);
    }

    #[Route('/admin-editeurs/{id}/delete', name: 'app_admin_editeur_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Editor $editor, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($editor);
        $entityManager->flush();

        $this->addFlash(
           'success',
           'La suppression a bien été effectuée !'
        );

        return $this->redirectToRoute('app_admin_editeurs');
    }

    #[Route('/admin-editeurs/add', name: 'app_admin_editeur_add')]
    #[Route('/admin-editeurs/{id}/edit', name: 'app_admin_editeur_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Editor $editor = null, EntityManagerInterface $entityManager, Request $request): Response
    {
        if (!$editor) {
            $editor = new Editor();
        }

        $form = $this->createForm(EditeurFormType::class, $editor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $editor = $form->getData();

            $entityManager->persist($editor);
            $entityManager->flush();

            $this->addFlash(
               'success',
               'La modification a bien été effectuée !'
            );

            return $this->redirectToRoute('app_admin_editeurs');
        }

        return $this->render('admin/editeurs/edit.html.twig', [
            'editor' => $editor,
            'form' => $form->createView(),
        ]);

    }
}
