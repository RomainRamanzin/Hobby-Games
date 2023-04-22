<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Entity\Article;
use App\Entity\Section;
use App\Repository\UserRepository;
use App\Form\ArticleFormType;
use App\Form\SectionFormType;
use App\Repository\SectionRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Exception as GlobalException;

class AdministrateurArticlesController extends AbstractController
{
    #[Route('/administrateur-articles', name: 'app_administrateur_articles')]
    public function index(ArticleRepository $articleRepository, UserRepository $userRepository): Response
    {
        $articles = $articleRepository->findAll();
        //trier par la date de publication
        usort($articles, function ($a, $b) {
            return $a->getPublicationDate() < $b->getPublicationDate();
        });
        $idColorGreen = [];
        $articlesData = [];
        foreach ($articles as $article) {
            if ($article->IsValided() == true) {
                $idColorGreen[] = $article->getId();
            }
            $id = $article->getWritedBy()->getId();
            $user = $userRepository->find($id);
            // On ajoute le pseudo de l'utilisateur à l'article
            $articlesData[] = [
                'article' => $article,
                'userPseudo' => $user->getPseudo(),
                // ajoutez d'autres informations nécessaires ici
            ];
        }

        return $this->render('administrateur_articles/index.html.twig', [
            'controller_name' => 'AdministrateurArticlesController',
            'articlesDatas' => $articlesData,
            'idColorGreen' => $idColorGreen,
        ]);
    }

    #[Route('/supprimer-section/{id}', name: 'app_administrateur_articles_delete_section')]
    public function deleteSection(int $id, EntityManagerInterface $em, SectionRepository $sectionRepository): Response
    {
        try {

            // On récupère l'id de la section à supprimer
            $section = $sectionRepository->find($id);
            $em->remove($section);
            $em->flush();

            $this->addFlash('success', 'La section a bien été supprimée !');
            return $this->redirectToRoute('app_modifier_article', ['id' => $section->getArticle()->getId()]);
        } catch (GlobalException $e) {
            $this->addFlash('danger', 'Une erreur est survenue lors de la suppression de la section !');
            return $this->render('app_modifier_article', ['id' => $section->getArticle()->getId()]);
        }
    }

    #[Route('/ajouter-actualite', name: 'app_ajout_actualite')]
    public function add(ArticleRepository $articleRepository, Request $request, EntityManagerInterface $em, UserRepository $userRepository): Response
    {
        try {
            $addArticle = true;
            // On crée un nouvel article
            $form = $this->createFormBuilder()
                // On ajoute les champs de l'article dans le formulaire
                ->add('article', ArticleFormType::class, ['label' => false])
                // On ajoute les champs de la section dans le formulaire
                ->add('section', SectionFormType::class, ['label' => false])
                //obtenir le formulaire
                ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $article = $data['article'];
                $section = $data['section'];

                // On vérifie que l'article n'existe pas déjà
                $existingArticle = $articleRepository->findOneBy(['title' => $article->getTitle()]);
                // Si l'article existe déjà, on affiche un message d'erreur
                if ($existingArticle) {
                    $this->addFlash('danger', 'Un article avec ce titre existe déjà !');
                    return $this->redirectToRoute('app_ajout_actualite');
                }
                // On récupère l'utilisateur connecté
                $user = $userRepository->find(1);
                // On ajoute les informations manquantes à l'article
                $article->setWritedBy($user);
                $article->setPublicationDate(new \DateTime());
                $article->setIsValided(false);
                $em->persist($article);
                $em->flush();
                // On ajoute les informations manquantes à la section
                $section->setArticle($article);
                $em->persist($section);
                $em->flush();

                $this->addFlash('success', 'Votre article a bien été enregistré !');
                return $this->redirectToRoute('app_administrateur_articles');
            }
        } catch (GlobalException $e) {
            $this->addFlash('danger', 'Une erreur est survenue !');
            return $this->redirectToRoute('app_ajout_actualite');
        }
        return $this->render('administrateur_articles/add.html.twig', ['form' => $form->createView(), 'addArticle' => $addArticle]);
    }

    #[Route('/modifier-article/{id}', name: 'app_modifier_article')]
    public function modifier_article(Section $section, ArticleRepository $articleRepository, Article $article, Request $request, EntityManagerInterface $em): Response
    {
        try {
            $form = $this->createForm(ArticleFormType::class, $article);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $article->setLastModifiedDate(new \DateTime());
                $em->persist($article);
                $em->flush();

                $this->addFlash('success', 'Votre article a bien été modifié !');
                return $this->redirectToRoute('app_administrateur_articles');
            }

            return $this->render('administrateur_articles/edit.html.twig', [
                'form' => $form->createView(),
            ]);
        } catch (\Exception $e) {
            $this->addFlash('error', 'Une erreur est survenue lors de la validation du formulaire: ' . $e->getMessage());
            return $this->redirectToRoute('app_modifier_article', ['id' => $section->getArticle()->getId()]);
        }
    }

    #[Route('/supprimer-actualite/{id}', name: 'app_supprimer_actualite')]
    public function delete(Article $article, SectionRepository $sectionRepository, EntityManagerInterface $em): Response
    {
        try {
            $id = $article->getId();

            $sections = $sectionRepository->findBy(['article' => $id]);

            if ($sections != '') {
                foreach ($sections as $section) {
                    $em->remove($section);
                }
            }
            $em->remove($article);
            $em->flush();

            $this->addFlash('success', 'Votre article a bien été supprimé !');
            return $this->redirectToRoute('app_administrateur_articles');
        } catch (\Exception $e) {

            $this->addFlash('error', 'Une erreur est survenue lors de la suppression de l\'article : ' . $e->getMessage());
            return $this->redirectToRoute('app_administrateur_articles');
        }
    }

    //ajouter une section a l'article
    #[Route('/ajouter-section/{id}', name: 'app_ajout_section')]
    public function sectionAction(Article $article, Request $request, EntityManagerInterface $em): Response
    {
        try {
            $addArticle = false;
            $section = new Section();

            $SectionForm = $this->createForm(SectionFormType::class, $section);

            $SectionForm->handleRequest($request);

            if ($SectionForm->isSubmitted() && $SectionForm->isValid()) {
                //set l'id de l'article dans la section
                $section->setArticle($article);
                $em->persist($section);
                $em->flush();
                $this->addFlash('success', 'Votre section a bien été ajoutée !');
                return $this->redirectToRoute('app_ajout_section', ['id' => $article->getId()]);
            }
        } catch (GlobalException $e) {
            $this->addFlash('error', 'Une erreur est survenue lors de l\'ajout de la section : ' . $e->getMessage());
            return $this->redirectToRoute('app_ajout_section', ['id' => $article->getId()]);
        }

        return $this->render('administrateur_articles/add.html.twig', ['SectionForm' => $SectionForm->createView(), 'article' => $article, 'addArticle' => $addArticle]);
    }

    //valider un article
    #[Route('/valider-articles/{id}', name: 'app_valider_article')]
    public function validate(Article $article, EntityManagerInterface $em): Response
    {
        try {
            $article->setIsValided(true);
            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Votre article a bien été validé !');
            return $this->redirectToRoute('app_administrateur_articles');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Une erreur est survenue lors de la validation de l\'article : ' . $e->getMessage());
            return $this->redirectToRoute('app_administrateur_articles');
        }
    }
}
