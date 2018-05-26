<?php

namespace App\Repository;

use App\Entity\Depense;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Depense|null find($id, $lockMode = null, $lockVersion = null)
 * @method Depense|null findOneBy(array $criteria, array $orderBy = null)
 * @method Depense[]    findAll()
 * @method Depense[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepenseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Depense::class);
    }

    public function getTotalDepenseByExComptable($ExerciceComptable)
    {
        $qb = $this->createQueryBuilder('d')
            ->addSelect('d.montantDepense')
            ->where('d.anneeDepense = :exCompt')
            ->setParameter('exCompt',$ExerciceComptable)
            ->Select('SUM(d.montantDepense) as resultat')
            ->getQuery()   
        ;

        return  $qb->getArrayResult();
    }

    public function getXDernieresDepenses($ExComptable)
    {
        $qb = $this->CreateQueryBuilder('d')
            ->where('d.anneeDepense = :exCompt')
            ->setParameter('exCompt',$ExComptable)
            ->setMaxResults(20)
            ->getQuery()
        ;
        return  $qb->getArrayResult();
    }
//    /**
//     * @return Depense[] Returns an array of Depense objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Depense
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
