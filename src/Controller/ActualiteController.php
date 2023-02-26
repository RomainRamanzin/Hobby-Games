<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualiteController extends AbstractController
{
    public function CallApi()
    {
        $json = file_get_contents('https://api.jvc.gg/news/datePublished.desc?preset=all&publicationType=game_news&offset=0&limit=20');
        $data = json_decode($json, true);

        $actualites = [];
        $actualites = $data['data']['items'];

        return $actualites;
    }

    public function AllActu()
    {
        $actualites = $this->CallApi();

        $allActus = [];
        foreach ($actualites as $actualite) {
            $strDate = substr($actualite['datePublished'], 5, 2);
            $jourActuel = date("m");
            if ($strDate == $jourActuel) {
                array_push($allActus, $actualite);
            }
        }

        return $allActus;
    }

    public function TopActu()
    {
        $actualites = $this->CallApi();

        $actuTop = [];
        $current_date = date("Y-m-d H:i:s");

        foreach ($actualites as $actualite) {
            $date = str_replace(array('T', 'Z'), ' ', $actualite['datePublished']);
            array_push($actuTop, $date);
        }

        usort($actuTop, function ($a, $b) use ($current_date) {
            $t1 = abs(strtotime($a) - strtotime($current_date));
            $t2 = abs(strtotime($b) - strtotime($current_date));
            return $t1 - $t2;
        });

        $five_closest_dates = array_slice($actuTop, 0, 5);

        $top = [];
        foreach ($actualites as $actualite) {
            $date = str_replace(array('T', 'Z'), ' ', $actualite['datePublished']);
            if (in_array($date, $five_closest_dates)) {
                array_push($top, $actualite);
            }
        }

        return $top;
    }

    public function ActuJour()
    {
        $actualites = $this->CallApi();

        $top = $this->TopActu();

        $actujours = [];
        foreach ($actualites as $actualite) {
            $strDate = substr($actualite['datePublished'], 8, 2);
            $jourActuel = date("d");
            if ($strDate == $jourActuel) {
                array_push($actujours, $actualite);
                $actujours = array_udiff($actujours, $top, function ($a, $b) {
                    return serialize($a) === serialize($b) ? 0 : 1;
                });
            }
        }

        return $actujours;
    }

    #[Route('/actualite', name: 'app_actualite')]
    public function index(): Response
    {
        $actualites = $this->CallApi();

        $top = $this->TopActu();

        $actujours = $this->ActuJour();

        $allActus = $this->AllActu();

        return $this->render('actualite/index.html.twig', [
            'controller_name' => 'ActualiteController',
            'allActus' => $allActus,
            'actujours' => $actujours,
            'top' => $top,
        ]);
    }
}
