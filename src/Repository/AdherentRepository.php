<?php

namespace App\Repository;

//use Doctrine
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

//Entité(s) utilisées
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

 //Retourne le nombre D'adhérent (Membres et Donateurs à jour ou non)
     /**
     * @param 
     * @return NombreAdherent(int)
     */
    public function CountByAdherent()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT COUNT(*) FROM `adherent` 
            WHERE `type_adherent_id`=1
            OR`type_adherent_id`=2
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return (int) $stmt->fetchAll();
    }

    //Retourne le nombre de membres dont la cotisation est à jour
     /**
     * @param 
     * @return NombreAdherentAJourDeCotisation(int)
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
        // Récupérer un tableau de tableau (une ligne de la base de données)
        return $stmt->fetchAll();
    }

    //Retourne le nombre de membres dont la cotisation est à jour
     /**
     * @param 
     * @return NombreMembreNonAJourDeCotisation(int)
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

    //Retourne le nombre de donateurs de l'exercice comptable en cours
    /**
     * @param 
     * @return NombreDeDonateur(int)
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
    
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    //Retourne la liste des Adhérents  à jour de leur cotisation
     /**
     * @param 
     * @return ListeDesMembreAJourDeCotisation(array)
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
    
        // Récupérer un tableau de tableau (une ligne de la base de données)
        return $stmt->fetchAll();
    }


    //Retourne la liste des Smith dont l'anniv est dans le mois en cours
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
        WHERE dayofyear(date_naissance_smith) - dayofyear(NOW()) <30
        OR dayofyear(date_naissance_smith) + 365 - dayofyear(NOW()) <30
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    //Retourne la liste des membres et de leurs adresses
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
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }


    // public function getXDerniersMembres()
    //     {
    //         $conn = $this->getEntityManager()->getConnection();
    //         $sql = '
    //             SELECT * 
    //             FROM `adherent`,`coordonneEs`, `type_adherent`
    //             WHERE `adherent`.`coordonnees_id` = `coordonnees`.`id`
    //             AND `adherent`.`type_adherent_id`=`type_adherent`.`id`
    //             AND `adherent`.`actif`=true
    //             LIMIT 20
    //             ';
    //         $stmt = $conn->prepare($sql);
    //         $stmt->execute();
    
    //         // returns an array of arrays (i.e. a raw data set)
    //         return $stmt->fetchAll();
    //     }

        public function getXDerniersMembres()
        {
            $conn = $this->getEntityManager()->getConnection();
            $sql = '
                SELECT * 
                FROM `adherent`,`coordonneEs`, `type_adherent`,`recette`, `type_recette`
                WHERE `adherent`.`coordonnees_id` = `coordonnees`.`id`
                AND `adherent`.`type_adherent_id`=`type_adherent`.`id`
                AND `recette`.`adherent_id` = `adherent`.`id`
                AND `recette`.`type_recette_id` = `type_recette`.`id`
                AND `adherent`.`actif`=true
                AND `recette`.`recette_active`=true
                LIMIT 20
                ';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
    
            // returns an array of arrays (i.e. a raw data set)
            return $stmt->fetchAll();
        }







//    /**
//     * @return Adherent[] Returns an array of Adherent objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Adherent
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
