<?php

namespace App\Repository;

use App\Entity\ExerciceComptableDeReference;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ExerciceComptableDeReference|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExerciceComptableDeReference|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExerciceComptableDeReference[]    findAll()
 * @method ExerciceComptableDeReference[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciceComptableDeReferenceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExerciceComptableDeReference::class);
    }

//    /**
//     * @return ExerciceComptableDeReference[] Returns an array of ExerciceComptableDeReference objects
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
    public function findOneBySomeField($value): ?ExerciceComptableDeReference
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
