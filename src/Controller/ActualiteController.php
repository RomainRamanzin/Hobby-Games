<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticleRepository;
use App\Repository\SectionRepository;
use App\Entity\Article;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ActualiteController extends AbstractController
{
    #[Route('/actualite', name: 'app_actualite')]
    public function index(ArticleRepository $articleRepository, PaginatorInterface $paginator, Request $request): Response
    {
        // Récupération de toutes les actualités
        $articles = $articleRepository->findAllSorted();

        $copieArticles = [];
        foreach ($articles as $article) {
            if ($article->IsValided() == true) {
                $copieArticles[] = $article;
            }
        }

        // Récupération des 5 dernières actualités
        $topActu = array_slice($copieArticles, 0, 5);

        // Récupération de toutes les actualités sauf les 5 dernières
        $allActu = array_slice($copieArticles, 5);

        $formSearch = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('title', TextType::class, [
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ])
            ->getForm();

        $formSearch->handleRequest($request);

        if ($formSearch->isSubmitted() && $formSearch->isValid()) {

            $data = $formSearch->getData();

            $title = $data['title'];
        } else {
            $title = null;
        }

        $pagination = $paginator->paginate(
            $articleRepository->filterQuery($title),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('actualite/index.html.twig', [
            'controller_name' => 'ActualiteController',
            'allActu' => $allActu,
            'topActu' => $topActu,
            'pagination' => $pagination,
            'formSearch' => $formSearch->createView(),
        ]);
    }

    #[Route('/actualite/{id}', name: 'app_actualite_show', methods: ['GET'])]

    public function show(Article $articles, SectionRepository $sectionRepository, ArticleRepository $articleRepository): Response
    {

        //l'url par laquelle arrive l'utilisateur
        $url = (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
        $urlAdmin = false;
        if (strpos($url, '/administrateur-articles')) {
            $urlAdmin = true;
        }

        if ($articles->IsValided() == false && !$this->isGranted('ROLE_REDACTEUR')) {
            return $this->redirectToRoute('app_actualite');
        }
        // Récupération des sections de l'actualité
        $sections = $sectionRepository->findBy(['article' => $articles->getId()]);
        // Récupération de toutes les actualités
        $allArticles = $articleRepository->findAllSorted();

        // Suppression des titres sections Introduction, Conclusion, Information et Suite
        foreach ($sections as $section) {
            //mettre en minuscul le titre
            $titre = strtoupper($section->getTitle());

            if ($titre == 'introduction' || $titre == 'conclusion' || $titre == 'information' || $titre == 'suite' || $titre == 'pour en conclure') {
                $section->setTitle('');
            }
            //afficher les 1000 caractères de la description si plus alors coupé a la fin de la phrase 
            $description = $section->getDescription();
            if (strlen($description) > 1000) {
                $description = substr($description, 0, 1000);
                //a partir des 1000 caractères on cherche le prochain point pour couper la phrase
                $description = substr($description, 0, strrpos($description, ".") + 1);
                $section->setDescription($description);
            }
        }

        //boucle pour récupérer toutes les actualités sauf celle dans laquelle on est 
        foreach ($allArticles as $article) {
            if ($article->getId() != $articles->getId() && $article->IsValided() == true) {
                $randomArticle[] = $article;
            }
        }

        // Mélange du tableau
        shuffle($randomArticle);
        // Récupération des 5 premiers éléments
        $randomFive = array_slice($randomArticle, 0, 5);

        // Récupération de la date de publication de l'actualité
        $dateActu = $articles->getPublicationDate();

        return $this->render('actualite/show.html.twig', [
            'url' => $urlAdmin,
            'article' => $articles,
            'sections' => $sections,
            'dateActu' => $dateActu,
            'randomFive' => $randomFive
        ]);
    }
}
