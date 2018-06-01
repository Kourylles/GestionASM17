<?php

namespace App\Repository;

use App\Entity\FonctionCa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FonctionCa|null find($id, $lockMode = null, $lockVersion = null)
 * @method FonctionCa|null findOneBy(array $criteria, array $orderBy = null)
 * @method FonctionCa[]    findAll()
 * @method FonctionCa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FonctionCaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FonctionCa::class);
    }

//    /**
//     * @return FonctionCa[] Returns an array of FonctionCa objects
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
    public function findOneBySomeField($value): ?FonctionCa
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
