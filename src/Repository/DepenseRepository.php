<?php

namespace App\Repository;

//Composants Doctrine
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

//Use Entity
use App\Entity\Depense;

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
        $conn = $this->getEntityManager()->getConnection();
            $sql='
                SELECT * 
                FROM `depense` 
                WHERE depense.depense_active=true
                ORDER BY depense.date_depense DESC 
                LIMIT 20          
            ';
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
        }

    //Récupérer les Dépenses de l'exercice comptable en cours
    public function getToutesLesDepenses()
    {
        $conn = $this->getEntityManager()->getConnection();
            $sql='
                SELECT * 
                FROM `depense` 
                ORDER BY depense.date_depense DESC 
            ';
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
        }
    
    //Récupérer les Dépenses de l'exercice comptable en cours non rapprochées
    public function getDepensesNonRapprochees()
    {      
        $conn = $this->getEntityManager()->getConnection();
            $sql='
                SELECT * 
                FROM `depense`
                WHERE `rapprochee`= FALSE
                AND (`depense_active`= TRUE OR `depense_active` = FALSE)
                ORDER BY depense.date_depense ASC           
            ';
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
        }
}