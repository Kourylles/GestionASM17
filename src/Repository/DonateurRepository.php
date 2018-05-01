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
