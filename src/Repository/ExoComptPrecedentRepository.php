<?php

namespace App\Repository;

use App\Entity\ExoComptPrecedent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ExoComptPrecedent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExoComptPrecedent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExoComptPrecedent[]    findAll()
 * @method ExoComptPrecedent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExoComptPrecedentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExoComptPrecedent::class);
    }

//    /**
//     * @return ExoComptPrecedent[] Returns an array of ExoComptPrecedent objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExoComptPrecedent
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
