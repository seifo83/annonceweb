<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request; 
use App\Entity\Membre;
use App\Repository\MembreRepository as MR ;

use App\Form\MembreType;

class MembreController extends AbstractController
{
    /**
    * @Route("/membre/add", name="membre_add")
    */
    public function affiche()
    {
        $form = $this->createForm(MembreType::class);
        return $this->render('membre/formulaire.html.twig', [
            'form' => $form->createView()
        ]);
         
    }




   



}