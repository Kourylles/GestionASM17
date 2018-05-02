<?php

namespace App\Repository;

use App\Entity\PosteAnalytique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PosteAnalytique|null find($id, $lockMode = null, $lockVersion = null)
 * @method PosteAnalytique|null findOneBy(array $criteria, array $orderBy = null)
 * @method PosteAnalytique[]    findAll()
 * @method PosteAnalytique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PosteAnalytiqueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PosteAnalytique::class);
    }

//    /**
//     * @return PosteAnalytique[] Returns an array of PosteAnalytique objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PosteAnalytique
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
