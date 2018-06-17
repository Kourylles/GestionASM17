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

    public function getSommeTypeRecetteByExComptable()
        {
            $conn = $this->getEntityManager()->getConnection();
            $sql ='
                SELECT `montant_recette`as resultat
                FROM `recette` 
                WHERE `recette_active`= true
                GROUP BY `type_recette_id`
            ';
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
        }

        public function getTotalRecetteByExComptable($ExerciceComptable)
        {
            $conn = $this->getEntityManager()->getConnection();
            $sql='
                SELECT SUM(`montant_recette`) as resultat
                FROM `recette` 
                WHERE `recette_active`=true            
            ';
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
        }

        public function getXDernieresRecettesParType($ExComptable, $TypeRecette1, $TypeRecette2)
        {
            $conn = $this->getEntityManager()->getConnection();
            $sql='
                SELECT * 
                FROM `adherent`,`coordonneEs`, `type_adherent`,`recette`, `type_recette`
                WHERE `adherent`.`coordonnees_id` = `coordonnees`.`id`
                AND `adherent`.`type_adherent_id`=`type_adherent`.`id`
                AND `recette`.`adherent_id` = `adherent`.`id`
                AND `recette`.`type_recette_id` = `type_recette`.`id`
                AND `adherent`.`actif`=true
                AND `recette`.`recette_active`=true
                LIMIT 20
            ';
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
        }
    

//Récupérer la somme total des recettes par type de recette

    // public function getSommeTypeRecetteByExComptable($ExerciceComptable)
    //     {
    //         $qb = $this->createQueryBuilder('r')
    //             ->addSelect('r.typeRecette')
    //             ->where('r.exerciceComptableRecette = :exCompt')
    //             ->setParameter('exCompt',$ExerciceComptable)
    //             ->Select('SUM(r.montantRecette) as resultat')
    //             ->groupBy('r.typeRecette')
    //             ->getQuery()   
    //         ;
    //         return  $qb->getArrayResult();
    //     }

    // public function getTotalRecetteByExComptable($ExerciceComptable)
    // {
    //     $qb = $this->createQueryBuilder('r')
    //         ->addSelect('r.montantRecette')
    //         ->where('r.exerciceComptableRecette = :exCompt')
    //         ->setParameter('exCompt',$ExerciceComptable)
    //         ->Select('SUM(r.montantRecette) as resultat')
    //         ->getQuery()   
    //     ;
    //     return  $qb->getArrayResult();
    // }

    // public function getXDernieresRecettesParType($ExComptable, $TypeRecette1, $TypeRecette2)
    // {
    //     $qb = $this->CreateQueryBuilder('r')
    //         ->join('r.typeRecette','t')
    //         ->addSelect('t')
    //         ->where('r.exerciceComptableRecette = :exCompt')
    //         ->andWhere('r.typeRecette =:typeRecette1')
    //         ->orWhere('r.typeRecette =:typeRecette2')
    //         ->setParameter('exCompt',$ExComptable)
    //         ->setParameter('typeRecette1',$TypeRecette1)        
    //         ->setParameter('typeRecette2',$TypeRecette2)
    //         ->setMaxResults(20)
    //         ->getQuery()
    //     ;
    //     return  $qb->getArrayResult();
    // }

//     SELECT * FROM `recette` 
// JOIN type_recette
// WHERE exercice_comptable_recette='2018'
// AND type_recette_id='3'
// AND recette.type_recette_id=type_recette.id





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
