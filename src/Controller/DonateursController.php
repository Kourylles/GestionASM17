<?php
// GestionASM17/src/Controller/DonateursController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Donateur;
use App\Entity\Coordonnees;
use App\Entity\ExerciceComptableEnCours;
use App\Entity\Recette;


class DonateursController extends Controller
{
       
    public function afficherDonateurs()
    {

        //Récupère sous forme de tableau les Donateurs et leurs adresses
                $ListeDonateurEtAdresse = $this->getDoctrine()
                ->getRepository(Donateur::class)
                ->getDonateursEtAdresses();
        
                return $this->render('GestionASM17/donateurs.html.twig', array(
                    'ListeDonateurEtAdresse'=>$ListeDonateurEtAdresse
                ));
            }

    public function detailDonateurs($id)
    {
//Récupération de l'exercice comptable
        $ExComptableEnCours = $this->getDoctrine()
        ->getRepository(ExerciceComptableEnCours::class)
        ->findExComptableEnCours(); //une seule ligne dans la base avec id=1

//Récupère les données du donateur passé en paramètre dans une instance de Donateur
        $Donateur = $this->getDoctrine()
        ->getRepository(Donateur::class)
        ->find($id);       

// Récupère les coordonnées du donateur passé en paramètre
        $Coordonnees = $this->getDoctrine()
        ->getRepository(Coordonnees::class)
        ->find($Donateur->getCoordonnees());

//Récupère toutes les recettes du donateur dont l'Id est passé en paramètre dans la route
        $Recettes = $this->getDoctrine()
        ->getRepository(Recette::class)
        ->findByIdDonateur($Donateur->getId(),$ExComptableEnCours->getExerciceEnCours());
  
//Renvoi de la vue
        return $this->render('GestionASM17/detailDonateur.html.twig', array(
            'ExComptableEnCours'=>$ExComptableEnCours,
            'Donateur'=>$Donateur ,
            'Coordonnees'=>$Coordonnees ,
            'Recettes'=>$Recettes 
        ));
    }



}
