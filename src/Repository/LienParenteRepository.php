<?php

namespace App\Repository;

use App\Entity\LienParente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LienParente|null find($id, $lockMode = null, $lockVersion = null)
 * @method LienParente|null findOneBy(array $criteria, array $orderBy = null)
 * @method LienParente[]    findAll()
 * @method LienParente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LienParenteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LienParente::class);
    }

//    /**
//     * @return LienParente[] Returns an array of LienParente objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LienParente
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
