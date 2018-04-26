<?php

namespace App\Repository;

use App\Entity\FonctionCA;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FonctionCA|null find($id, $lockMode = null, $lockVersion = null)
 * @method FonctionCA|null findOneBy(array $criteria, array $orderBy = null)
 * @method FonctionCA[]    findAll()
 * @method FonctionCA[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FonctionCARepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FonctionCA::class);
    }

//    /**
//     * @return FonctionCA[] Returns an array of FonctionCA objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FonctionCA
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
