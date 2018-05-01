<?php

namespace App\Repository;

use App\Entity\ExerciceComptableEnCours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ExerciceComptableEnCours|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExerciceComptableEnCours|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExerciceComptableEnCours[]    findAll()
 * @method ExerciceComptableEnCours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciceComptableEnCoursRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExerciceComptableEnCours::class);
    }


    public function findExComptableEnCours()
    {
        return $this->createQueryBuilder('e')
            // ->addSelect('e.exerciceEnCours')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
//    /**
//     * @return ExerciceComptableEnCours[] Returns an array of ExerciceComptableEnCours objects
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
    public function findOneBySomeField($value): ?ExerciceComptableEnCours
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
