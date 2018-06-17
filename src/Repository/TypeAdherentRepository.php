<?php

namespace App\Repository;

use App\Entity\TypeAdherent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeAdherent|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeAdherent|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeAdherent[]    findAll()
 * @method TypeAdherent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeAdherentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeAdherent::class);
    }

//    /**
//     * @return TypeAdherent[] Returns an array of TypeAdherent objects
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
    public function findOneBySomeField($value): ?TypeAdherent
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
