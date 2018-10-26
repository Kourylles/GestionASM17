<?php

namespace App\Repository;

//Composants Doctrine
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

//Use Entity
use App\Entity\Recette;

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

    //Récupérer la somme des recettes actives classées par type de recettes 
    public function getSommeTypeRecetteByExComptable()
        {
            $conn = $this->getEntityManager()->getConnection();
            $sql ='
                SELECT SUM(montant_recette) as resultat
                FROM recette
                WHERE recette.recette_active = 1
                GROUP BY recette.type_recette_id
            ';
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
        }
    //Récupérer la somme totale des recettes en cours
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
    //Récupère toutes les recettes de l'exercice comptable en cours (ie les recettes actives)
    public function getToutesLesRecettes()
        {
            $conn = $this->getEntityManager()->getConnection();
            $sql = '
                SELECT * 
                FROM `recette`
                
                ORDER BY recette.date_paiement_recette DESC
                
            ';
//ORDER BY recette.date_paiement_recette DESC, recette.type_recette_id ASC   , `type_recette` WHERE type_recette.id = recette.type_recette_id
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
        }

    //Récupérer les 20 dernières recettes enregistrées
    public function getXDernieresRecettesParType($ExComptable, $TypeRecette1, $TypeRecette2)
        {
            $conn = $this->getEntityManager()->getConnection();
            $sql = '
                SELECT * 
                FROM `recette`, `type_recette`
                WHERE recette.type_recette_id = type_recette.id
                AND recette_active = true
                AND recette.type_recette_id BETWEEN 2 AND 5
                ORDER BY recette.date_paiement_recette DESC, recette.type_recette_id ASC
                LIMIT 20
            ';
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
        }

    //Récupère le Membre dont l'Id est passé en paramètre
    public function findByAdherent($IdMembre)
    {
        $conn = $this->getEntityManager()->getConnection();
            $sql='
                SELECT * 
                FROM `recette` 
                INNER JOIN type_recette
                ON recette.type_recette_id=type_recette.id
                WHERE `adherent_id`='.$IdMembre.'
                ORDER BY `exercice_comptable_recette`DESC';
            
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
    }

    //Récupère le Donateur dont l'Id est passé en paramètre
    public function findByIdDonateur($IdDonateur)
    {
        $conn = $this->getEntityManager()->getConnection();
            $sql='
                SELECT * 
                FROM `recette` 
                INNER JOIN type_recette
                ON recette.type_recette_id=type_recette.id
                WHERE `adherent_id`='.$IdDonateur.'
                ORDER BY `exercice_comptable_recette`DESC';
            
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
    }

    //Récupérer les Recettes de l'exercice comptable en cours non rapprochées
    public function getRecettesNonRapprochees()
    {      
        $conn = $this->getEntityManager()->getConnection();
            $sql='
                SELECT * 
                FROM `recette`
                WHERE `etat_rapprochement_recette`= FALSE
                ORDER BY `recette`.`date_paiement_recette` ASC
            ';
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
        }

}
