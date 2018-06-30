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

    //Récupérer la somme totale des recettes en cours
    public function getTotalDepenseByExComptable($ExerciceComptable)
        {
            $conn = $this->getEntityManager()->getConnection();
            $sql='
                SELECT SUM(`montant_depense`) as resultat
                FROM `depense` 
                WHERE `depense_active`= true            
            ';
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
        }
    //Récupérer les 20 dernières dépenses enregistrées
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
