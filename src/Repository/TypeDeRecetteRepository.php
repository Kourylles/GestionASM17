<?php

namespace App\Repository;

use App\Entity\TypeDeRecette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeDeRecette|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeDeRecette|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeDeRecette[]    findAll()
 * @method TypeDeRecette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeDeRecetteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeDeRecette::class);
    }

//    /**
//     * @return TypeDeRecette[] Returns an array of TypeDeRecette objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeDeRecette
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
