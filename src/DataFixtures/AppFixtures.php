<?php

namespace App\DataFixtures;

use App\Entity\Adherent;
use App\Entity\Coordonnees;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(
        ObjectManager $entityManager
        //Repository $repoTypeAdherent
        ) {

        //Récupération des types d'adhérents
        //$typeAdh = $repoTypeAdherent->findAll();

        //Utilisation de la librairie Faker pour créer des données réalistes
        $faker = Factory::create('fr-FR');

        //boucle pour créer 30 adhérents dans la BDD
        for ($i = 1; $i <= 30; $i++) {
            //Création d'une instance d'adhérent
            $adherent = new Adherent();

            //Récupération de données vraissemblable grâce à la librairie Faker
            $nom = $faker->name();
            $prenom = $faker->firstName();
            $dateCreation = $faker->date($format = 'Y-m-d', $max = 'now');
            $observation = $faker->sentence();

            //Hydratation de l'instance de l'annonce
            $adherent->setNom($nom)
                ->setPrenom($prenom)
            // ->setDateCreation($dateCreation)
                ->setObservation($observation)
                ->setActif(mt_rand(0, 1))
                ->setTypeAdherent(mt_rand(1, 4))
                ->setIsSmith(mt_rand(0, 1))
                ->setLienParente(mt_rand(1, 6))
                ->setEstAussiDonateur(mt_rand(0, 1))
                ->setCoordonnees($i);

            //Création de l'adresse associée
            $coordonnees = new Coordonnees();
            if (substr($nom, 0) == "n") {

                $ligneAdresse1 = $faker->secondaryAddress;

            }
            if ($ligneAdresse1 == "" and substr($adherent->getNom(), 1) == "a") {

                $ligneAdresse2 = $faker->sentence(mt_rand(2, 4));

            }
            $ligneAdresse3 = $faker->streetAddress();
            $codepostal = $faker->postcode();
            $ville = $faker->city();
            $tel = $faker->phoneNumber();
            $mail = $faker->freeMail();

            $coordonnees->setLigneAdr1($ligneAdresse1)
                ->setLigneAdr2($ligneAdresse2)
                ->setLigneAdr3($ligneAdresse3)
                ->setCodePostal($codepostal)
                ->setVille($ville)
                ->setTelephone1($tel)
                ->setEmail1($mail);

            //Prevenir Doctrine que nous allons faire persister cette instance
            $entityManager->persist($ad);
            $entityManager->persist($coordonnees);

        }
        //Connexion à la BDD et enregistrement de toutes les entitées créées
        $entityManager->flush();
    }
}
