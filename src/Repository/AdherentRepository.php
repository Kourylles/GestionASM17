<?php

namespace App\Repository;

//Composants Doctrine
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

//Use Entity
use App\Entity\Adherent;

/**
 * @method Adherent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adherent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adherent[]    findAll()
 * @method Adherent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdherentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Adherent::class);
    }

 //Récupération du nombre total d'adhérent (Membres et Donateurs à jour ou non)
     /**
     * @param 
     * @return NombreAdherent
     */
    public function CountByMembre()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT COUNT(*) as total
            FROM `adherent` 
            WHERE `type_adherent_id`=1
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //Récupération du nombre de membres dont la cotisation est à jour 
     /**
     * @param 
     * @return NombreAdherentAJourDeCotisation
     */
    public function getMembreAjourCoti()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT COUNT(*) as ajour
            FROM adherent 
            WHERE `type_adherent_id`=1
            AND `actif`=true
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();    
        return $stmt->fetchAll();
    }

    //Récupération du nombre de membres non à jour de leur cotisation
     /**
     * @param 
     * @return NombreMembreNonAJourDeCotisation
     */
    public function getMembreNonAjourCoti()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT COUNT(*) as nonAjour
            FROM adherent 
            WHERE `type_adherent_id`=1
            AND `actif`=false
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    //Récupération du nombre de donateurs de l'exercice comptable en cours
    /**
     * @param 
     * @return NombreDeDonateur
     */
    public function getDonateurExoEnCours()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql='
            SELECT COUNT(*) as ajour
            FROM `adherent`
            WHERE `type_adherent_id`=2
            AND `actif`=true
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //Récupération de la liste membres à jour de leur cotisation
     /**
     * @param 
     * @return ListeDesMembreAJourDeCotisation
     */
    public function getListeMembreAjourCoti()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT * FROM `adherent` 
            WHERE `type_adherent_id`= 1
            AND `actif`=true
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    //Récupération de la liste des Smith dont l'anniverssaire est dans le mois en cours
     /**
     * @param 
     * @return TableauDeSmith(array)
     */
    public function getTableauAnnivSmith(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT * 
            FROM adherent 
            INNER JOIN `smith`
            ON `adherent`.`smith_lie_id` = `smith`.`id`
            INNER JOIN `coordonnees`
            ON `adherent`.`coordonnees_id` = `coordonnees`.`id`
            WHERE dayofyear(date_naissance_smith) - dayofyear(NOW()) <= 30
            AND dayofyear(date_naissance_smith) - dayofyear(NOW()) >0
            OR dayofyear(date_naissance_smith) + 365 - dayofyear(NOW()) <= 30
            AND dayofyear(date_naissance_smith) + 365 - dayofyear(NOW()) >0
            ORDER BY adherent.actif DESC, smith.date_naissance_smith  DESC
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //Récupération de la liste des membres et de leurs adresses
     /**
     * @param 
     * @return ListeAdherentEtAdresse(array)
     */
    public function getMembresEtAdresses(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT * 
            FROM adherent 
            INNER JOIN `coordonnees`
            ON `adherent`.`coordonnees_id`= `coordonnees`.`id`
            WHERE  `type_adherent_id`=1
            ORDER BY adherent.actif DESC, adherent.nom ASC
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

        //Récupération des données relatives aux 20 derniers Adhérents enregistrés
        /**
         * @param 
         * @return ListeAdherentEtAdresse(array)
         */
        public function getXDerniersMembres()
        {
            $conn = $this->getEntityManager()->getConnection();
            $sql = '
                SELECT * 
                FROM `adherent`,`coordonnees`, `type_adherent`,`recette`, `type_recette`
                WHERE `adherent`.`coordonnees_id` = `coordonnees`.`id`
                AND `adherent`.`type_adherent_id`=`type_adherent`.`id`
                AND `recette`.`adherent_id` = `adherent`.`id`
                AND `recette`.`type_recette_id` = `type_recette`.`id`
                AND `adherent`.`actif`=true
                AND `recette`.`recette_active`=true
                ORDER BY adherent.date_modification DESC, adherent.type_adherent_id ASC
                LIMIT 20
                ';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

    //Récupération de la liste des donateurs et de leurs adresses
     /**
     * @param 
     * @return ListeAdherentEtAdresse(array)
     */
    public function getDonateursEtAdresses(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT adherent.id, nom,prenom,date_creation, date_modification,observation, actif,ligne_adr1, ligne_adr2, ligne_adr3, code_postal, ville, email1
            FROM `adherent`, `coordonnees`
            WHERE `adherent`.`coordonnees_id`= `coordonnees`.`id`
            AND  `type_adherent_id`=2
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

        //Récupération de la liste des professionnels et de leurs adresses
     /**
     * @param 
     * @return ListeProfessionnelsEtAdresse(array)
     */
    public function getProEtAdresses(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT adherent.id, nom,prenom,date_creation, date_modification,observation, actif,ligne_adr1, ligne_adr2, ligne_adr3, code_postal, ville, email1
            FROM `adherent`, `coordonnees`
            WHERE `adherent`.`coordonnees_id`= `coordonnees`.`id`
            AND  `type_adherent_id`=3
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }




}
