<?php

namespace App\Repository;

use App\Entity\Membre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

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

    /**
     * 
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
        FROM membre 
        INNER JOIN `coordonnees`
        ON `membre`.`coordonnees_id` = `coordonnees`.`id`
        ';
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // returns an array of arrays (i.e. a raw data set)
    return $stmt->fetchAll();
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
