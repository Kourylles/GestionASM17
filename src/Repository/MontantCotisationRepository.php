<?php

namespace App\Repository;

use App\Entity\MontantCotisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MontantCotisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method MontantCotisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method MontantCotisation[]    findAll()
 * @method MontantCotisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MontantCotisationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MontantCotisation::class);
    }

//    /**
//     * @return MontantCotisation[] Returns an array of MontantCotisation objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MontantCotisation
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
