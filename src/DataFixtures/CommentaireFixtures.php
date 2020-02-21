<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Commentaire;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class CommentaireFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(2, "commentaire", function($num){
            $commentaire = (new Commentaire)
                                        ->setCommentaire($this->faker->words($nb = 3, $asText = true))
                                        ->setDateEnregistrement($this->faker->dateTime())
                                        ->setMembreId($this->getRandomReference("utilisateur"))
                                        ->setAnnonceId($this->getRandomReference("annonce"));
            return $commentaire;


        });
        $manager->flush();
    }

    public function getDependencies(){
        return [ MembreFixtures::class, AnnonceFixtures::class ];
    }
}
