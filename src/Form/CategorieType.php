<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Contrainte;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('titre' , TextType::class, ["data" => "Tapez le titre de la categorie"]) // on peut ajouter quelque
            //->add('motscles', TextareaType::class, ["help" => "Tapez les mots cles"])
            //on peut écrire de cette facon 
            ->add('titre' , TextType::class, ["help" => "Tapez le titre de la categorie", 
                                               "data" => "Catégorie",
                                               "constraints" => [
                                                                    new Contrainte\NotBlank(["message" => "Vous avez oublié de remplir les champs"]),
                                                                    new Contrainte\Length(["min" => 2, "max" => 20,
                                                                                    "minMessage" => "Le titre doit avoir au moins 2 caractéres",
                                                                                    "maxMessage" => "Le titre ne doit pas dépasser 20 caractéres"])
                                               ]
                                               ])
        // on ajouter la classe Constrainte 
        // 1- on doit ajouter la ligne use Symfony\Component\Validator\Constraints as Contrainte;
        //2- permet de si  $form->isValid()  est valide de notre formulaire ou non 
        // le test se fait dans le fichier CategorieType.php
            ->add('motscles', TextareaType::class, ["label" => "Mots cles", "help" => "Tapez les mots clés"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
