<?php
// GestionASM17/src/Controller/MembresController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Membre;
use App\Entity\Coordonnees;
use App\Entity\ExerciceComptableEnCours;
use App\Entity\Smith;
use App\Entity\LienParente;
use App\Entity\FonctionCa;
use App\Entity\Recette;

class MembresController extends Controller
{
       
    public function afficherMembres()
    {

//Récupère sous forme de tableau les Membres et leurs adresses
        $ListeMembreEtAdresse = $this->getDoctrine()
        ->getRepository(Membre::class)
        ->getMembresEtAdresses();

//Récupère la cotisation en cours pour en afficher la date dans la vue
        // $CotiEnCours = $this->getDoctrine()
        // ->getRepository(Recette::class)
        // ->getExoComptableDerniereCoti($Membre->getId(),"1");

        return $this->render('GestionASM17/membres.html.twig', array(
            'ListeMembresEtAdresses'=>$ListeMembreEtAdresse
        //     'DatePaiementCotiMembre'=>$DatePaiementCotiMembre ,
        //     'CotiEnCours'=>$CotiEnCours
        ));
    }

    public function detailMembres($id)
    {
//Récupération de l'exercice comptable
        $ExComptableEnCours = $this->getDoctrine()
        ->getRepository(ExerciceComptableEnCours::class)
        ->findExComptableEnCours(); //une seule ligne dans la base avec id=1

//Récupère les données du membre passé en paramètre dans une instance de membre
        $Membre = $this->getDoctrine()
        ->getRepository(Membre::class)
        ->find($id);  

// Récupère les coordonnées du membres passé en paramètre
        $Coordonnees = $this->getDoctrine()
        ->getRepository(Coordonnees::class)
        ->find($Membre->getCoordonnees());

//Récupère le libellé du lien de parenté en fonction du code contenu dans l'entity Membre
        $LienDeParente =$this->getDoctrine()
        ->getRepository(LienParente::class)
        ->find($Membre->getLienParente());

//Récupère le libellé de la fonction CA en fonction du code contenu dans l'entity Membre
        $FonctionCa =$this->getDoctrine()
        ->getRepository(FonctionCa::class)
        ->find($Membre->getFonctionCa());

//Récupère toutes les recettes du membre dont l'Id est passé en paramètre dans la route
        $Recettes = $this->getDoctrine()
        ->getRepository(Recette::class)
        ->findByIdMembre($Membre->getId(),$ExComptableEnCours->getExerciceEnCours());   
  
//Renvoi de la vue
        return $this->render('GestionASM17/detailMembre.html.twig', array(
            'ExComptableEnCours'=>$ExComptableEnCours,
            'Membre'=>$Membre ,
            'Coordonnees'=>$Coordonnees ,
            'Recettes'=>$Recettes ,
            'LienDeParente'=>$LienDeParente ,
            'FonctionCa'=>$FonctionCa 
        ));
    }



}
