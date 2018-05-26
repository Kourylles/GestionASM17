<?php
// GestionASM17/src/Controller/GestionASM17Controller.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Membre;
use App\Entity\Donateur;
use App\Entity\Smith;
use App\Entity\Recette;
use App\Entity\ExerciceComptableEnCours;
use App\Entity\Depense;
use App\Form\AnnivOkType;

class GestionASM17Controller extends Controller
{

    public function accueil(Request $request)
    {
//Récupère le nombre de membres total à jour de cotisation ou non
        $NbreMembre=$this->getDoctrine()
        ->getRepository(Membre::class)
        ->countByMembre();

//Récupération de l'exercice comptable en cours
        $ExComptableEnCours = $this->getDoctrine()
        ->getRepository(ExerciceComptableEnCours::class)
        ->findExComptableEnCours(); //une seule ligne dans la base avec id=1        

//Récupère le nombre de membre à jour ou non à jour de leur cotisation pour l'exercice comptable en cours
        //Nbre de membres à jour
        $NbreMembreOkCoti = $this->getDoctrine()
        ->getRepository(Membre::class)
        ->getMembreAjourCoti();//id 1 de la table type de recette=cotisation
        //Nbre de membres non à jour
        $NbreMembreNokCoti = $this->getDoctrine()
        ->getRepository(Membre::class)
        ->getMembreNonAjourCoti();//id 1 de la table type de recette=cotisation

//Récupère le nombre de donateurs
        $NbreDonateur =$this->getDoctrine()
        ->getRepository(Donateur::class)
        ->countByDonateur();
//Tableau des Recettes : Total par type de recettes
        $SommeParTypeDeRecette = $this->getDoctrine()
        ->getRepository(Recette::class)
        ->getSommeTypeRecetteByExComptable($ExComptableEnCours->getExerciceEnCours());
//Tableau des Recettes : Total des recettes
        $TotalRecette = $this->getDOctrine()
        ->getRepository(Recette::class)
        ->getTotalRecetteByExComptable($ExComptableEnCours->getExerciceEnCours());
//Tableau des Dépenses : Total des dépenses  
        $TotalDepense= $this->getDoctrine()
        ->getRepository(Depense::class)
        ->getTotalDepenseByExComptable($ExComptableEnCours->getExerciceEnCours());;

//Jointure membre-smith pour récupérer les infos sur le Smith au regarde de la propriété smithLie
       $ListeMembreTableauAnnivSmith = $this->getDoctrine()
        ->getRepository(Membre::class)
        ->getTableauAnnivSmith();

//Récupère les 20 dernières recettes
        $DernieresRecettes = $this->getDoctrine()
        ->getRepository(Recette::class)
        ->getXDernieresRecettesParType($ExComptableEnCours->getExerciceEnCours(),3,4);
        // var_dump($DernieresRecettes);die;

//Récupère les 20 dernières recettes
$DernieresDepenses = $this->getDoctrine()
->getRepository(Depense::class)
->getXDernieresDepenses($ExComptableEnCours->getExerciceEnCours());
// var_dump($DernieresRecettes);die;

// Récupère les 20 derniers membres ajoutés
$DerniersMembres = $this->getDoctrine()
->getRepository(Membre::class)
->getXDerniersMembres($ExComptableEnCours->getExerciceEnCours(),1,2);

//Création du formulaire qui va permettre de passer à "True" le booleen qui stocke
//l'envoi de la carte d'anniverssaire
        // foreach ($ListeMembreTableauAnnivSmith as $value) {
        //         $smith = new Smith();
        //         $AnnivEnvoyeForm = $this->createForm(AnnivOkType::class, $smith);
        //         $AnnivEnvoyeForm->handleRequest($request);
        // }
        // $smith = new Smith();
        // $AnnivEnvoyeForm = $this->createForm(AnnivOkType::class, $smith);
        // $AnnivEnvoyeForm->handleRequest($request);

        return $this->render('GestionASM17/accueil.html.twig', array(
            'NbreMembre'=>$NbreMembre,
            'NbreMembreOkCoti'=>$NbreMembreOkCoti,
            'NbreMembreNokCoti'=>$NbreMembreNokCoti,
            'NbreDonateur'=>$NbreDonateur,
            'TotalRecette'=>$TotalRecette,
            'SommeParTypeDeRecette'=>$SommeParTypeDeRecette,
            'TotalDepense'=>$TotalDepense,
            'ListeMembreTableauAnnivSmith'=>$ListeMembreTableauAnnivSmith,
            'DernieresRecettes'=>$DernieresRecettes,
            'DernieresDepenses'=>$DernieresDepenses,
            'DerniersMembres'=>$DerniersMembres
        //     'AnnivEnvoyeForm' => $AnnivEnvoyeForm->createView(),
        ));
    }
}
