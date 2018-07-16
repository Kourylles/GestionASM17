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

    //Récupérer les recettes actives classées par type de recettes 
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
                WHERE `adherent_id`=
            '.$IdMembre;
            
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
                WHERE `adherent_id`=
            '.$IdDonateur;
            
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
    }

}
