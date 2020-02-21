<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface ;
use App\Entity\Categorie;
use Symfony\Component\HttpFoundation\Request;  //Comme pour la réponse, tout ce qui est lié à la requête est représenté et manipulable par une classe spécifique.

use App\Form\CategorieType;
use App\Repository\CategorieRepository as CR;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie/liste", name="categorie_liste")
     */
    public function liste(CR $catrep)
    {
        $liste = $catrep->findAll();
        //dd($liste);


        return $this->render('categorie/liste.html.twig',['liste'=>$liste]);
    }


// une route pour afficher le formulaire
    /**
    * @Route("/categorie/add", name="categorie_form", methods="GET")
    */
    public function affiche()
    {
        $form = $this->createForm(CategorieType::class);
        return $this->render('categorie/index.html.twig', [
            'form' => $form->createView()
        ]);
         
    }


    // une route pour  envoyer le formulaire

    /**
    * @Route("/categorie/add", name="categorie_add", methods="POST")
    */
   /* public function envoyer(Request $request, EntityManagerInterface $em)  
    {    
        $titre = $request->request->get("categorie")["titre"];
        $motscles = $request->request->get("categorie")["motscles"];

            $categorie = new Categorie;
            $categorie->setTitre($titre); // permet de récuperer la valeur de titre
            $categorie->setMotscles($motscles); // permet de récuperer la valeur de description
            $em->persist($categorie);  //$em récuperer les valeur  Pour enregistrer en base de données
            $resultat = $em->flush(); //Pour exécuter

            // on peut envoyer par cette methode vers la vue en utilisent form cela methode1
       /* $form = $this->createForm(CategorieType::class);
            return $this->render('categorie/index.html.twig', [
                'form' => $form->createView(),
            ]);*/

            //methode 2 pour envoyer les données avec une redirection vers un autre Route

            //return $this->redirectToroute("home");
    

    //}
    


    /**
    * @Route("/categorie/add", name="categorie_add", methods="POST")
    */
    public function envoyer(Request $request, EntityManagerInterface $em)  
    {    //les donnes du $_POST etre récuperer avec 
        //$request->request->get("nomduFormulaire") qui est un arry (comme $_POST)

        //1- creeer le formulaire
            $form = $this->createForm(CategorieType::class);
        //2- Passer la requéte HTTP au formulaire
            $form->handleRequest($request);
            //lla fonction handleRequest permet de verifier que $form notre formulaire
            // est bien était envoyer ou valider 

        if($form->isSubmitted() && $form->isValid()){
                
                $data  = $form->getData();
                // la fonction getData permet de récuperer les données envoyées
        //$data remplace $request->request->get("categorie")
        // la 1er facon on a ecrire de cette facon 

               // $titre = $request->request->get("categorie")["titre"];
               // $motscles = $request->request->get("categorie")["motscles"];

        // avec $data 
        // on recupere les données envoyées (si le formulaire est lié a une entité, getData()
        // renvoie un objet de la classe de cette entité ("categorie"))

        // dans ce cas on pas besoin de creer un nouveau objet de la classe catégorie 
        // puisque $data est creer par $form->getData(); et $ form creer de la classe Catégorie
        

            // au debut on a fit cette partie
                   // $categorie = new Categorie;
                    //$categorie->setTitre($titre); // permet de récuperer la valeur de titre
                    //$categorie->setMotscles($motscles); // permet de récuperer la valeur de description
                    //$em->persist($categorie);  //$em récuperer les valeur  Pour enregistrer en base de données
                    //$resultat = $em->flush(); //Pour exécuter
            // avec $data 

                $em->persist($data);
                $em->flush();
                $this->addFlash('success', 'la catégorie a bien été enregistrée !');
                return $this->redirectToroute("home"); 
        
        
        }
        elseif (!$form->isValid()) {
            $this->addFlash('Error', 'Les données du formulaire ne sont pas valides');
            //$form = $this->createForm(CategorieType::class, $form->getData());
            return $this->render('categorie/index.html.twig', [
                'form' => $form->createView()
                ]);


        }
               

                // on peut envoyer par cette methode vers la vue en utilisent form cela methode1
        /* $form = $this->createForm(CategorieType::class);
                return $this->render('categorie/index.html.twig', [
                    'form' => $form->createView(),
                ]);*/

                //methode 2 pour envoyer les données avec une redirection vers un autre Route

        

    }



}
