<?php

namespace App\Controller\admin;

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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Exception as GlobalException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\File;
use Doctrine\ORM\PersistentCollection;

class ArticlesController extends AbstractController
{
    #[Route('/administrateur-articles', name: 'app_administrateur_articles')]
    #[IsGranted("ROLE_REDACTEUR")]
    public function index(ArticleRepository $articleRepository, UserRepository $userRepository): Response
    {
        $articles = $articleRepository->findAll();
        //trier par la date de publication
        usort($articles, function ($a, $b) {
            return $a->getPublicationDate() < $b->getPublicationDate();
        });

        $idColorGreen = [];
        $articlesData = [];
        // On récupère les articles
        foreach ($articles as $article) {
            // On vérifie si l'article est validé
            if ($article->IsValided() == true) {
                $idColorGreen[] = $article->getId();
            }
            // On récupère l'id de l'utilisateur qui a écrit l'article
            $id = $article->getWritedBy()->getId();
            // On récupère l'utilisateur qui a écrit l'article
            $user = $userRepository->find($id);
            // On ajoute le pseudo de l'utilisateur à l'article
            $articlesData[] = [
                'article' => $article,
                'userPseudo' => $user->getPseudo(),
                // ajoutez d'autres informations nécessaires ici
            ];
        }
        return $this->render('admin/articles/index.html.twig', [
            'controller_name' => 'AdministrateurArticlesController',
            'articlesDatas' => $articlesData,
            'idColorGreen' => $idColorGreen,
        ]);
    }

    #[Route('/administrateur-articles/supprimer-section/{id}', name: 'app_administrateur_articles_delete_section')]
    #[IsGranted("ROLE_REDACTEUR")]
    public function deleteSection(int $id, EntityManagerInterface $em, SectionRepository $sectionRepository): Response
    {
        try {
            //si il y a qu'une section il est pas possible de supprimer
            $section = $sectionRepository->find($id);
            $article = $section->getArticle();
            $sections = $article->getSections();
            // On vérifie qu'il y a plus d'une section
            if (count($sections) == 1) {
                $this->addFlash('danger', 'Il est impossible de supprimer la section !');
                return $this->redirectToRoute('app_modifier_article', ['id' => $article->getId()]);
            }
            // On récupère l'id de la section à supprimer
            $section = $sectionRepository->find($id);
            $em->remove($section);
            $em->flush();

            $this->addFlash('success', 'La section a bien été supprimée !');
            return $this->redirectToRoute('app_modifier_article', ['id' => $article->getId()]);
        } catch (\Exception $e) {
            $this->addFlash('danger', 'Une erreur est survenue lors de la suppression de la section !');
            return $this->render('app_modifier_article', ['id' => $article->getId()]);
        }
    }

    #[Route('/administrateur-articles/ajouter-article', name: 'app_ajout_actualite')]
    #[IsGranted("ROLE_REDACTEUR")]
    public function add(MailerInterface $mailer, ArticleRepository $articleRepository, Request $request, EntityManagerInterface $em, UserRepository $userRepository): Response
    {
        $addArticle = true;
        // On crée un nouvel article
        $form = $this->createFormBuilder()
            // On ajoute les champs de l'article dans le formulaire
            ->add('article', ArticleFormType::class, ['label' => false])
            // On ajoute les champs de la section dans le formulaire
            ->add('section', SectionFormType::class, ['label' => false])
            //obtenir le formulaire
            ->getForm();

        //permet de recuperer les données et de les associer au formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $data = $form->getData();
                $article = $data['article'];
                $section = $data['section'];

                $pictureArticleFile = $form->get('article')['cover']->getData();
                $pictureSectionFile = $form->get('section')['picture']->getData();

                if ($pictureArticleFile && $pictureSectionFile) {
                    $originalFilenameA = pathinfo($pictureArticleFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $newFilenameA = uniqid() . '.' . $pictureArticleFile->guessExtension();

                    $originalFilenameS = pathinfo($pictureSectionFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $newFilenameS = uniqid() . '.' . $pictureSectionFile->guessExtension();

                    try {
                        $pictureArticleFile->move(
                            'article_image',
                            $newFilenameA
                        );

                        $pictureSectionFile->move(
                            'section_image',
                            $newFilenameS
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    $article->setCover('/article_cover/' . $newFilenameA);
                    $section->setPicture('/section_image/' . $newFilenameS);
                }




                if (strlen($section->getDescription()) > 1000) {
                    $this->addFlash('danger', 'La description de la section est trop longue !');
                    return $this->redirectToRoute('app_ajout_actualite');
                }

                // On vérifie que l'article n'existe pas déjà
                $existingArticle = $articleRepository->findOneBy(['title' => $article->getTitle()]);
                // Si l'article existe déjà, on affiche un message d'erreur
                if ($existingArticle) {
                    $this->addFlash('danger', 'Un article avec ce titre existe déjà !');
                    return $this->redirectToRoute('app_ajout_actualite');
                }
                // On récupère l'utilisateur connecté
                $user = $this->getUser();
                // On ajoute les informations manquantes à l'article
                $article->setWritedBy($user);
                $article->setPublicationDate(new \DateTime());
                $article->setIsValided(false);
                $em->persist($article);

                // On ajoute les informations manquantes à la section
                $section->setArticle($article);
                $em->persist($section);

                $em->flush();

                // $redacteurs = $userRepository->findByRole($role = 'ROLE_REDACTEUR');
                // $utilisateurConnecte = $this->getUser();

                // foreach ($redacteurs as $redacteur) {
                //     if ($redacteur !== $utilisateurConnecte) {
                //         $email = (new Email())
                //             ->from('contact.hobbygames@gmail.com')
                //             ->to($redacteur->getEmail())
                //             ->subject('Nouvel article à valider')
                //             ->html('Salut ' . $redacteur->getPseudo() . '<br>' . '<br>' .
                //                 'Nous sommes heureux de vous informer qu\'un nouvel article passionnant vient d\'arriver et attend maintenant votre validation. Cet article promet d\'apporter de nouvelles perspectives et de captiver notre public. ' . '<br>' . '<br>' .
                //                 'Voici le titre de l\'article : ' . '"' . $article->getTitle() . '"' . '<br>' . '<br>' .
                //                 'Vous pouvez consulter l\'article en attente de validation en cliquant sur le lien suivant : <a href="http://127.0.0.1:8000/login">Hobby Games</a>');
                //         $mailer->send($email);
                //     }
                // }

                $this->addFlash('success', 'Votre article a bien été enregistré !');
                return $this->redirectToRoute('app_administrateur_articles');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Une erreur est survenue lors de l\'ajout de l\'article : ' . $e->getMessage());
                return $this->redirectToRoute('app_ajout_actualite');
            }
        }

        return $this->render('admin/articles/add.html.twig', ['form' => $form->createView(), 'addArticle' => $addArticle]);
    }

    #[Route('/administrateur-articles/modifier-article/{id}', name: 'app_modifier_article')]
    #[IsGranted("ROLE_REDACTEUR")]
    public function modifier_article(Article $article, Request $request, EntityManagerInterface $em): Response
    {
        try {
            //créer le formulaire de modification de l'article
            $form = $this->createForm(ArticleFormType::class, $article);

            //permet de recuperer les données et de les associer au formulaire
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $article = $form->getData();

                //edit de l'article
                $pictureArticleFile = $form->get('cover')->getData();

                if($pictureArticleFile){
                    $newFilename = uniqid() . '.' . $pictureArticleFile->guessExtension();

                    try {
                        $pictureArticleFile->move(
                            'article_image',
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    $article->setCover('/article_cover/' . $newFilename);
                }

                //sections

                // get all sections in the form
                $sections = $form->get('sections');
                // $pictureSectionFile = $form->get('sections')[0]->get('picture')->getData();
                foreach($sections as $formSection){
                    $pictureSectionFile = $formSection->get('picture')->getData();
                    $Section = $formSection->getData();

                    if($pictureSectionFile){
                        $newFilename = uniqid() . '.' . $pictureSectionFile->guessExtension();

                        try {
                            $pictureSectionFile->move(
                                'section_image',
                                $newFilename
                            );
                        } catch (FileException $e) {
                            // ... handle exception if something happens during file upload
                        }

                        $Section->setPicture('/section_image/' . $newFilename);
                        $em->persist($Section);
                    }
                }

                $article->setLastModifiedDate(new \DateTime('Europe/Paris'));
                $em->persist($article);
                $em->flush();

                $this->addFlash('success', 'Votre article a bien été modifié !');
                return $this->redirectToRoute('app_administrateur_articles');
            }

            /**
             * afficher à l'utilisateur le formulaire de modification de l'article
             *  avec les erreurs de validation éventuelles
             **/
            return $this->render('admin/articles/edit.html.twig', [
                'form' => $form->createView(),
            ]);
        } catch (\Exception $e) {
            $this->addFlash('error', 'Une erreur est survenue lors de la validation du formulaire: ' . $e->getMessage());
            return $this->redirectToRoute('app_modifier_article', ['id' => $article->getId()]);
        }
    }

    #[Route('/administrateur-articles/supprimer-article/{id}', name: 'app_supprimer_actualite')]
    #[IsGranted("ROLE_REDACTEUR")]
    public function delete(Article $article, SectionRepository $sectionRepository, EntityManagerInterface $em): Response
    {
        try {
            $id = $article->getId();

            // On récupère les sections de l'article
            $sections = $sectionRepository->findBy(['article' => $id]);

            // On supprime les sections de l'article
            foreach ($sections as $section) {
                $em->remove($section);
            }

            // On supprime l'article
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
    #[Route('/administrateur-articles/ajouter-section/{id}', name: 'app_ajout_section')]
    #[IsGranted("ROLE_REDACTEUR")]
    public function sectionAction(Article $article, Request $request, EntityManagerInterface $em): Response
    {
        $addArticle = false;

        // On crée une nouvelle section
        $section = new Section();
        // On ajoute l'article à la section
        $section->setArticle($article);

        // On crée le formulaire de la section
        $SectionForm = $this->createForm(SectionFormType::class, $section);

        //permet de recuperer les données et de les associer au formulaire
        $SectionForm->handleRequest($request);

        if ($SectionForm->isSubmitted() && $SectionForm->isValid()) {
            try {
                $pictureSectionFile = $SectionForm->get('picture')->getData();

                if ($pictureSectionFile) {
                    $originalFilenameS = pathinfo($pictureSectionFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $newFilenameS = uniqid() . '.' . $pictureSectionFile->guessExtension();

                    try {
                        $pictureSectionFile->move(
                            'section_image',
                            $newFilenameS
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    $section->setPicture('/section_image/' . $newFilenameS);
                }

                $em->persist($section);
                $em->flush();
                $this->addFlash('success', 'Votre section a bien été ajoutée !');
                return $this->redirectToRoute('app_ajout_section', ['id' => $article->getId()]);
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de l\'ajout de la section : ' . $e->getMessage());
                return $this->redirectToRoute('app_ajout_section', ['id' => $article->getId()]);
            }
        }

        return $this->render('admin/articles/add.html.twig', ['SectionForm' => $SectionForm->createView(), 'article' => $article, 'addArticle' => $addArticle]);
    }

    //valider un article
    #[Route('/administrateur-articles/valider-articles/{id}', name: 'app_valider_article')]
    #[IsGranted("ROLE_REDACTEUR")]
    public function validate(Article $article, EntityManagerInterface $em): Response
    {
        try {
            // On vérifie que l'utilisateur connecté n'est pas l'auteur de l'article
            if ($this->getUser()->getUserIdentifier() != $article->getWritedBy()->getEmail()) {
                $article->setIsValided(true);
                $em->persist($article);
                $em->flush();
                $this->addFlash('success', 'Votre article a bien été validé !');
                return $this->redirectToRoute('app_administrateur_articles');
            }

            $this->addFlash('danger', 'Vous ne pouvez pas valider votre propre article !');
            return $this->redirectToRoute('app_administrateur_articles');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Une erreur est survenue lors de la validation de l\'article : ' . $e->getMessage());
            return $this->redirectToRoute('app_administrateur_articles');
        }
    }
}
