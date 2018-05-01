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
//Récupération des cotisation de l'année d'exercice en cours

public function findNbreRecetteParType($annee, $TypeRecette)
    {
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('r')
            ->addSelect('count(r)')
            ->getQuery();

        return (int) $qb->getResult();
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
