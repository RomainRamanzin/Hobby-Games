<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticleRepository;
use App\Repository\SectionRepository;
use App\Repository\GameRepository;
use App\Entity\Article;
use App\Repository\UserRepository;
use App\Form\ArticleFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\String\Slugger\SluggerInterface;


class ActualiteController extends AbstractController
{
    #[Route('/actualite', name: 'app_actualite')]
    public function index(ArticleRepository $articleRepository): Response
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

        return $this->render('actualite/index.html.twig', [
            'controller_name' => 'ActualiteController',
            'allActu' => $allActu,
            'topActu' => $topActu,
        ]);
    }

    #[Route('/actualite/{id}', name: 'app_actualite_show', methods: ['GET'])]
    public function show(Article $articles, SectionRepository $sectionRepository, ArticleRepository $articleRepository): Response
    {
        // Récupération des sections de l'actualité
        $sections = $sectionRepository->findBy(['article' => $articles->getId()]);
        // Récupération de toutes les actualités
        $allArticles = $articleRepository->findAllSorted();

        // Suppression des sections Introduction, Conclusion, Information et Suite
        foreach ($sections as $section) {
            if ($section->getTitle() == 'Introduction' || $section->getTitle() == 'Conclusion' || $section->getTitle() == 'Information' || $section->getTitle() == 'Suite' || $section->getTitle() == 'Pour en conclure') {
                $section->setTitle('');
            }
        }

        //boucle pour récupérer toutes les actualités sauf celle dans laquelle on est 
        foreach ($allArticles as $article) {
            if ($article->getId() != $articles->getId()) {
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
            'article' => $articles,
            'sections' => $sections,
            'dateActu' => $dateActu,
            'randomFive' => $randomFive
        ]);
    }
}
