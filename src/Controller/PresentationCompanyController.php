<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresentationCompanyController extends AbstractController
{
    #[Route('/presentation-entreprise', name: 'app_presentation_company')]
    public function index(): Response
    {
        return $this->render('presentation_company/index.html.twig', [
            'controller_name' => 'PresentationCompanyController',
        ]);
    }
}
