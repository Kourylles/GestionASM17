<?php
// GestionASM17/src/Controller/GestionASM17Controller.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Membre;
use App\Entity\Donateur;
use App\Entity\Smith;
use App\Entity\Recette;
use App\Entity\ExerciceComptableEnCours;

class GestionASM17Controller extends Controller
{
    public function accueil()
    {
//Récupère le nombre de membres total à jour de cotisation ou non
        $NbreMembre=$this->getDoctrine()
        ->getRepository(Membre::class)
        ->countByMembre();

//Récupère le nombre de membre à jour de leur cotisation pour l'exercice comptable en cours
        //Récupération de l'exercice comptable en cours
        $ExComptableEnCours = $this->getDoctrine()
        ->getRepository(ExerciceComptableEnCours::class)
        ->findExComptableEnCours(); //une seule ligne dans la base avec id=1
        //Calcul du nombre de coti payée pour l'exercice comptable en cours
        $NbreMembreOkCoti = $this->getDoctrine()
        ->getRepository(Recette::class)
        ->findNbreRecetteParType($ExComptableEnCours,"1");//id 1 de la table type de recette=cotisation

//Calcul du nombre de membre non à jour de cotisation
        $NbreMembreNokCoti = ($NbreMembre - $NbreMembreOkCoti);

//Récupère le nombre de donateurs
        $NbreDonateur =$this->getDoctrine()
        ->getRepository(Donateur::class)
        ->countByDonateur();
// //Tableau des Recettes
        $SommeParTypeDeRecette = $this->getDoctrine()
        ->getRepository(Recette::class)
        ->getSommeTypeRecetteByExComptable($ExComptableEnCours->getExerciceEnCours());

        $TotalRecette = $this->getDOctrine()
        ->getRepository(Recette::class)
        ->getTotalRecetteByExComptable($ExComptableEnCours->getExerciceEnCours());
//  var_dump($TotalRecette);die;    
        $TotalDepense="99999";
        // $TotalRecette ="99999";

//Jointure membre-smith pour récupérer les infos sur le Smith au regarde de la propriété smithLie
       $ListeMembreTableauAnnivSmith = $this->getDoctrine()
        ->getRepository(Membre::class)
        ->getTableauAnnivSmith();

        return $this->render('GestionASM17/accueil.html.twig', array(
            'NbreMembre'=>$NbreMembre,
            'NbreMembreOkCoti'=>$NbreMembreOkCoti,
            'NbreMembreNokCoti'=>$NbreMembreNokCoti,
            'NbreDonateur'=>$NbreDonateur,
            // 'TableauSommeTypeRecettes'=> $TableauSommeTypeRecettes,
            'TotalRecette'=>$TotalRecette,
            'SommeParTypeDeRecette'=>$SommeParTypeDeRecette,
            'TotalDepense'=>$TotalDepense,
            'ListeMembreTableauAnnivSmith'=>$ListeMembreTableauAnnivSmith
        ));
    }
}
