<?php

namespace App\Repository;

use App\Entity\ValeurCotisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ValeurCotisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ValeurCotisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ValeurCotisation[]    findAll()
 * @method ValeurCotisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValeurCotisationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ValeurCotisation::class);
    }

//    /**
//     * @return ValeurCotisation[] Returns an array of ValeurCotisation objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ValeurCotisation
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
