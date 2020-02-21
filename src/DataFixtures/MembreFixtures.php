<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Membre;

class MembreFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, "admin", function($num){
            //Création d'un utilisateur Admin
            $membreAdmin = new Membre;
            $membreAdmin->setPseudo("admin$num");
            $membreAdmin->setNom($this->faker->lastName);
            $membreAdmin->setPrenom($this->faker->firstName);
            $email = "admin" . $num . "@annonceweb.com";
            $membreAdmin->setEmail($email);
            $membreAdmin->setPassword(password_hash("admin" . $num, PASSWORD_DEFAULT));
            $membreAdmin->setCivilite($this->faker->randomElement(["H", "F", "A"]));
            $membreAdmin->setRoles(["ROLE_ADMIN"]);
            $membreAdmin->setTelephone($this->faker->e164PhoneNumber);
            $membreAdmin->setDateEnregistrement($this->faker->dateTime());
            return $membreAdmin;
        });

        $this->createMany(200, "utilisateur", function($num){
            //Création d'un utilisateur 
            $membreUtilistateur = new Membre;
            $membreUtilistateur->setPseudo("utilisateur$num");
            $membreUtilistateur->setNom($this->faker->lastName);
            $membreUtilistateur->setPrenom($this->faker->firstName);
            $email = "utilisateur" . $num . "@annonceweb.com";
            $membreUtilistateur->setEmail($email);
            $membreUtilistateur->setPassword(password_hash("utilisateur" . $num, PASSWORD_DEFAULT));
            $membreUtilistateur->setCivilite($this->faker->randomElement(["H", "F", "A"]));
            $membreUtilistateur->setRoles(["ROLE_USER"]);
            $membreUtilistateur->setTelephone($this->faker->e164PhoneNumber);
            $membreUtilistateur->setDateEnregistrement($this->faker->dateTime());
            return $membreUtilistateur;
        });
        $manager->flush();
    }
}



