<?php
// GestionASM17/src/Controller/GestionASM17Controller.php
namespace App\Controller;

//Use Symfony
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//Entitées utilisées
use App\Entity\Adherent;
use App\Entity\Donateur;
use App\Entity\Smith;
use App\Entity\Recette;
use App\Entity\ExerciceComptableEnCours;
use App\Entity\Depense;

//Repositories utilisés
use App\Repository\AdherentRepository;
use App\Repository\ExerciceComptableEnCoursRepository;
use App\Repository\DonateurRepository;
use App\Repository\RecetteRepository;
use App\Repository\DepenseRepository;

//Formulaires utilisées
use App\Form\AnnivOkType;

class GestionASM17Controller extends Controller
{
    public function accueil(
            Request $request, 
            AdherentRepository $repoAdherent,
            ExerciceComptableEnCoursRepository $repoExoCompt,
            DonateurRepository $repoDonateur,
            RecetteRepository $repoRecette,
            DepenseRepository $repoDepense)
    {
//Récupère le nombre total de membres jour de cotisation ou non
        $nbreAdherent = $repoAdherent->CountByMembre();
//Récupération de l'exercice comptable en cours, la table ne contient qu'un champ d'id=1
        $exComptableEnCours = $repoExoCompt->findExComptableEnCours(); 
//Récupère le nombre de membre à jour ou non à jour de leur cotisation pour l'exercice comptable en cours
        //Nbre d'adhérent à jour
        $nbreMembreCotiOk = $repoAdherent->getMembreAjourCoti();
        //Nbre de membres non à jour
        $nbreMembreNokCoti = $repoAdherent->getMembreNonAjourCoti();
//Récupère le nombre de donateurs de l'exercice comptable en cours
        $nbreDonateur =$repoAdherent->getDonateurExoEnCours();
//Tableau des Recettes : Total par type de recettes
        $sommeParTypeDeRecette = $repoRecette->getSommeTypeRecetteByExComptable($exComptableEnCours->getExerciceEnCours());
        //Tableau des Recettes : Total des recettes
        $totalRecette = $repoRecette->getTotalRecetteByExComptable($exComptableEnCours->getExerciceEnCours());
//Tableau des Dépenses : Total des dépenses  
        $totalDepense= $repoDepense->getTotalDepenseByExComptable($exComptableEnCours->getExerciceEnCours());;
//Jointure membre-smith pour récupérer les infos sur le Smith au regarde de la propriété smithLie
        $listeMembreTableauAnnivSmith = $repoAdherent->getTableauAnnivSmith();
//Récupère les 20 dernières recettes
        $dernieresRecettes = $repoRecette->getXDernieresRecettesParType($exComptableEnCours->getExerciceEnCours(),3,4);
//Récupère les 20 dernières dépenses
        $dernieresDepenses = $repoDepense->getXDernieresDepenses($exComptableEnCours->getExerciceEnCours());
// Récupère les 20 derniers membres ajoutés
        $derniersMembres = $repoAdherent->getXDerniersMembres($exComptableEnCours->getExerciceEnCours(),1,2);

//Le controleur retourne une vue en lui passant les paramètres necessaires
        return $this->render('GestionASM17/accueil.html.twig', array(
            'exComptableEnCours'=>$exComptableEnCours,
            'nbreAdherent'=>$nbreAdherent,
            'nbreMembreCotiOk'=>$nbreMembreCotiOk,
            'nbreMembreNokCoti'=>$nbreMembreNokCoti,
            'nbreDonateur'=>$nbreDonateur,
            'totalRecette'=>$totalRecette,
            'sommeParTypeDeRecette'=>$sommeParTypeDeRecette,
            'totalDepense'=>$totalDepense,
            'listeMembreTableauAnnivSmith'=>$listeMembreTableauAnnivSmith,
            'dernieresRecettes'=>$dernieresRecettes,
            'dernieresDepenses'=>$dernieresDepenses,
            'derniersMembres'=>$derniersMembres
        ));
    }
}
