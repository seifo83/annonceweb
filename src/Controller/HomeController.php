<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository as CR;
use App\Repository\MembreRepository as MR;
use App\Repository\AnnonceRepository as AR;



class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CR $catRepo, MR $membreRepo, AR $annRepo, AR $villRepo)
    {
        $categories = $catRepo->findAll();
        $membres = $membreRepo->findAll();
        $annonces = $annRepo->findAll();
        $regions= $villRepo->findVille();
        //dd($regions);



        return $this->render("base.html.twig", compact("categories", "membres", "annonces", "regions"));
    }
}
