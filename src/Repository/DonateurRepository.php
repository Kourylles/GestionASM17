<?php

namespace App\Repository;

use App\Entity\Donateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Donateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Donateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Donateur[]    findAll()
 * @method Donateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonateurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Donateur::class);
    }

    /**
     * @param 
     * @return NombreDeDonateur(int)
     */
    public function CountByDonateur()
    {
        $qb = $this->createQueryBuilder('d');
        $qb ->select($qb->expr()->count('d'));
 
    return (int) $qb->getQuery()->getSingleScalarResult();
    }

//Retourne le nombre de donateur dont le don correspond à l'exercie comptable en cours
     /**
     * @param 
     * @return NombreDeDonateurDeExoComptableEnCOurs(int)
     */
    public function getDonateurExoEnCours()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT COUNT(*) as ajour
            FROM donateur 
            WHERE donateur.don_ok = TRUE
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
 // Récupérer un tableau de tableau (une ligne de la base de données)
 return $stmt->fetchAll();
}



    public function getDonateursEtAdresses(): array
{
    $conn = $this->getEntityManager()->getConnection();

    $sql = '
        SELECT * 
        FROM coordonnees 
        INNER JOIN `donateur`
        ON `donateur`.`coordonnees_id`= `coordonnees`.`id`
        ';
    $stmt = $conn->prepare($sql);
    $stmt->execute();


// SELECT * 
// FROM membre 
// INNER JOIN `coordonnees`
// ON `membre`.`coordonnees_id`= `coordonnees`.`id`

    // returns an array of arrays (i.e. a raw data set)
    return $stmt->fetchAll();
}




//    /**
//     * @return Donateur[] Returns an array of Donateur objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Donateur
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
