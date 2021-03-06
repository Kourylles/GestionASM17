<?php

namespace App\Repository;

//Use Synfony
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

//Use Doctrine
use Symfony\Bridge\Doctrine\RegistryInterface;

//Entitées utilisées
use App\Entity\Membre;

/**
 * @method Membre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Membre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Membre[]    findAll()
 * @method Membre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MembreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Membre::class);
    }
    
    //Retourne le nombre de membre
     /**
     * @param 
     * @return NombreDeMembre(int)
     */
    public function CountByMembre()
    {
        $qb = $this
            ->createQueryBuilder('m');
        $qb ->select($qb->expr()->count('m'));
 
        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    //Retourne la liste des membres  à jour de leur cotisation
     /**
     * @param 
     * @return ListeDesMembreAJourDeCotisation(array)
     */
    public function getListeMembreAjourCoti()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT * 
            FROM membre 
            WHERE membre.coti_ok = TRUE
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        // Récupérer un tableau de tableau (une ligne de la base de données)
        return $stmt->fetchAll();
    }

//Retourne le nombre de membre dont la cotisation est à jour
     /**
     * @param 
     * @return NombreDeMembreAJourDeCotisation(int)
     */
    public function getMembreAjourCoti()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT COUNT(*) as ajour
            FROM membre 
            WHERE membre.coti_ok = TRUE
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();    
        // Récupérer un tableau de tableau (une ligne de la base de données)
        return $stmt->fetchAll();
    }

    public function getMembreNonAjourCoti()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT COUNT(*) as nonAjour
            FROM membre 
            WHERE membre.coti_ok = FALSE
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

      /**
     * @param 
     * @return ListeDesMembresLiesAUnSmith(array)
     */
    public function getMembreAvecSmith()
    {
        $qb = $this
            ->createQueryBuilder('m')
            ->innerJoin('m.smithLie','s')
            ->addSelect('s.')
        ;
        return $qb
            ->getQuery()
            ->getArrayResult()
        ;
    }

    public function getTableauAnnivSmith(): array
{
    $conn = $this->getEntityManager()->getConnection();

    $sql = '
        SELECT * 
        FROM membre 
        INNER JOIN `smith`
        ON `membre`.`smith_lie_id` = `smith`.`id`
        INNER JOIN `coordonnees`
        ON `membre`.`coordonnees_id` = `coordonnees`.`id`
        WHERE dayofyear(date_naissance_smith) - dayofyear(NOW()) <30
        OR dayofyear(date_naissance_smith) + 365 - dayofyear(NOW()) <30
        AND smith.anniv_envoye = false
        ';
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // returns an array of arrays (i.e. a raw data set)
    return $stmt->fetchAll();
}

public function getMembresEtAdresses(): array
{
    $conn = $this->getEntityManager()->getConnection();

    $sql = '
        SELECT * 
        FROM coordonnees 
        INNER JOIN `membre`
        ON `membre`.`coordonnees_id`= `coordonnees`.`id`
        ';
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // returns an array of arrays (i.e. a raw data set)
    return $stmt->fetchAll();
}

public function getXDerniersMembres()
{
    $qb = $this->CreateQueryBuilder('m')
        ->join('m.coordonnees','c')
        ->addSelect('c')
        ->andwhere('m.coordonnees = c.id')
        ->setMaxResults(20)
        ->getQuery()
    ;
    return  $qb->getArrayResult();
}


//    /**
//     * @return Membre[] Returns an array of Membre objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Membre
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
