<?php

namespace App\Repository;

use App\Entity\Smith;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Smith|null find($id, $lockMode = null, $lockVersion = null)
 * @method Smith|null findOneBy(array $criteria, array $orderBy = null)
 * @method Smith[]    findAll()
 * @method Smith[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SmithRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Smith::class);
    }

//    /**
//     * @return Smith[] Returns an array of Smith objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Smith
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
