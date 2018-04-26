<?php

namespace App\Repository;

use App\Entity\Parente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Parente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parente[]    findAll()
 * @method Parente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParenteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Parente::class);
    }

//    /**
//     * @return Parente[] Returns an array of Parente objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Parente
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
