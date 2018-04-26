<?php

namespace App\Repository;

use App\Entity\Personne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Personne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personne[]    findAll()
 * @method Personne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonneRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Personne::class);
    }

    /**
     * @param $price
     * @return Product[]
     */
    public function CountTypePersonne($typePersonne)
    {
    
        // "p" est l'alias de l'entitée Personne à utiliser dans le reste de la requête
        $qb = $this->createQueryBuilder('p')
            ->where('p.typePersonne = :typePersonne')
            ->getQuery();

        return $qb->execute();

        // to get just one result:
        // $product = $qb->setMaxResults(1)->getOneOrNullResult();
    }




    public function countByAccount(Account $account)
    {
        $qb = $this->createQueryBuilder('e');
 
        $qb ->select($qb->expr()->count('e'))
            ->where('e.account = :account')
                ->setParameter('account', $account);
 
        return (int) $qb->getQuery()->getSingleScalarResult();
    }

//    /**
//     * @return Personne[] Returns an array of Personne objects
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
    public function findOneBySomeField($value): ?Personne
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
