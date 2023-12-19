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
        //Ajout article valide dans le tableau
        foreach ($articles as $article) {
            if ($article->IsValided() == true) {
                $copieArticles[] = $article;
            }
        }

        // Récupération des 5 dernières actualités
        $topActu = array_slice($copieArticles, 0, 5);

        // Création du formulaire de recherche
        $formSearch = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('title', TextType::class, [
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ])
            ->getForm();

        // Récupération des données du formulaire
        $formSearch->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($formSearch->isSubmitted() && $formSearch->isValid()) {
            // Récupération des données du formulaire
            $data = $formSearch->getData();
            // Récupération du titre
            $title = $data['title'];
        } else {
            $title = null;
        }

        // Récupération des articles filtrés
        $pagination = $paginator->paginate(
            // Appel de la méthode de filtrage
            $articleRepository->filterQuery($title),
            // Définition du numéro de page
            $request->query->getInt('page', 1),
            // Nombre d'éléments par page
            10
        );

        return $this->render('actualite/index.html.twig', [
            'controller_name' => 'ActualiteController',
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
        //si l'url contient /administrateur-articles alors on est dans l'admin
        if (strpos($url, '/administrateur-articles')) {
            $urlAdmin = true;
        }

        // Si l'article n'est pas validé et que l'utilisateur n'est pas redacteur
        if ($articles->IsValided() == false && !$this->isGranted('ROLE_REDACTEUR')) {
            // Redirection vers la page d'accueil
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
            //si la description est plus longue que 1000 caractères
            if (strlen($description) > 1000) {
                //on coupe la description a 1000 caractères
                $description = substr($description, 0, 1000);
                //a partir des 1000 caractères on cherche le prochain point pour couper la phrase
                $description = substr($description, 0, strrpos($description, ".") + 1);
                $section->setDescription($description);
            }
        }

        //boucle pour récupérer toutes les actualités sauf celle dans laquelle on est 
        foreach ($allArticles as $article) {
            //si l'id de l'article est différent de l'id de l'article dans lequel on est et que l'article est validé alors on l'ajoute dans le tableau
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
