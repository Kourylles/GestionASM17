<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Recette::class);
    }

//Récupérer la somme total des recettes par type de recette

    public function getSommeTypeRecetteByExComptable($ExerciceComptable)
        {
            $qb = $this->createQueryBuilder('r')
                ->addSelect('r.typeRecette')
                ->where('r.exerciceComptableRecette = :exCompt')
                ->setParameter('exCompt',$ExerciceComptable)
                ->Select('SUM(r.montantRecette) as resultat')
                ->groupBy('r.typeRecette')
                ->getQuery()   
            ;

            return  $qb->getArrayResult();
        }

    public function getTotalRecetteByExComptable($ExerciceComptable)
    {
        $qb = $this->createQueryBuilder('r')
            ->addSelect('r.montantRecette')
            ->where('r.exerciceComptableRecette = :exCompt')
            ->setParameter('exCompt',$ExerciceComptable)
            ->Select('SUM(r.montantRecette) as resultat')
            ->getQuery()   
        ;

        return  $qb->getArrayResult();
    }

    public function getXDernieresRecettes($ExComptable)
    {
        $qb = $this->CreateQueryBuilder('r')
            ->where('r.exerciceComptableRecette = :exCompt')
            ->andWhere(limit(10))
            ->setParameter('exCompt',$ExComptable)
        ;
    }

    // /**
    //  * @return Recette[] Returns an array of Recette objects
    //  */
    
    // public function getExoComptableDerniereCoti($IdMembre,$TypeCoti)
    // {
    //     $qb = $this->createQueryBuilder('r')
    //         // ->addSelect(max('r.exerciceComptableRecette'))
    //         ->andWhere('r.idMembre = :val')
    //         ->andwhere('r.typeRecette = :typeCoti')
    //         ->setParameter('val', $IdMembre)
    //         ->setParameter('typeCoti',$TypeCoti)
    //         ->orderBy('r.exerciceComptableRecette','DESC')
    //         ->setMaxResults(1)
    //         ->getQuery()
    //     ;
    //     return  $qb->getResult();
    // }

    public function findByIdMembre($IdMembre)
    {
        $qb = $this->createQueryBuilder('r')
            ->andWhere('r.idMembre = :val')
            ->setParameter('val', $IdMembre)
            ->orderBy('r.typeRecette','ASC')
            ->orderBy('r.exerciceComptableRecette', 'DESC')
            ->getQuery()
        ;
        return  $qb->getResult();
    }

    public function findByIdDonateur($IdDonateur)
    {
        $qb = $this->createQueryBuilder('r')
            ->andWhere('r.idDonateur = :val')
            ->setParameter('val', $IdDonateur)
            ->orderBy('r.typeRecette','ASC')
            ->orderBy('r.exerciceComptableRecette', 'DESC')
            ->getQuery()
        ;
        return  $qb->getResult();
    }
    
       
//    /**
//     * @return Recette[] Returns an array of Recette objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recette
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
