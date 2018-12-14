<?php
// GestionASM17/src/Controller/GestionASM17Controller.php
namespace App\Controller;

//Composants Symfony
use App\Entity\Donateur;

//Use Reposotory
use App\Repository\AdherentRepository;

//Use Form
use App\Repository\DepenseRepository;

//Use Entity
use App\Repository\DonateurRepository;
use App\Repository\ExerciceComptableEnCoursRepository;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

//Démarage d'une session pour créer des varibales de session si necessaire et éviter des requets Sql
if (!isset($_SESSION)) {
    session_start();
}

class GestionASM17Controller extends Controller
{
    public function accueil(
        Request $request,
        AdherentRepository $repoAdherent,
        ExerciceComptableEnCoursRepository $repoExoCompt,
        DonateurRepository $repoDonateur,
        RecetteRepository $repoRecette,
        DepenseRepository $repoDepense) {
//Récupère le nombre total de membres jour de cotisation ou non
        $nbreAdherent = $repoAdherent->CountByMembre();
//Récupération de l'exercice comptable en cours, la table ne contient qu'un champ d'id=1
        $exComptableEnCours = $repoExoCompt->findExComptableEnCours();
//Enregistrement de l'exrecice comptable en cours dans une variable de Session pour réutilisation dans les autres pages
        $_SESSION['exComptableEnCours'] = $exComptableEnCours->getExerciceEnCours();
//Récupère le nombre de membre à jour ou non à jour de leur cotisation pour l'exercice comptable en cours
        //Nbre d'adhérent à jour
        $nbreMembreCotiOk = $repoAdherent->getMembreAjourCoti();
        //Nbre de membres non à jour
        $nbreMembreNokCoti = $repoAdherent->getMembreNonAjourCoti();
//Récupère le nombre de donateurs de l'exercice comptable en cours
        $nbreDonateur = $repoAdherent->getDonateurExoEnCours();
//Tableau des Recettes : Total par type de recettes
        $sommeParTypeDeRecette = $repoRecette->getSommeTypeRecetteByExComptable($_SESSION['exComptableEnCours']);
//Récupère le nombre de Membres qui sont aussi donateurs
        $nbreMembreAussiDonateur = $repoAdherent->getMembresDonateurExoEnCours();
        dump($nbreMembreAussiDonateur);
//Tableau des Recettes : Total des recettes
        $totalRecette = $repoRecette->getTotalRecetteByExComptable($_SESSION['exComptableEnCours']);
//Tableau des Dépenses : Total des dépenses
        $totalDepense = $repoDepense->getTotalDepenseByExComptable($_SESSION['exComptableEnCours']);
//Jointure membre-smith pour récupérer les infos sur le Smith au regarde de la propriété smithLie
        $listeMembreTableauAnnivSmith = $repoAdherent->getTableauAnnivSmith();
//Récupère les 20 dernières recettes
        $dernieresRecettes = $repoRecette->getXDernieresRecettesParType($_SESSION['exComptableEnCours'], 3, 4);
//Récupère les 20 dernières dépenses
        $dernieresDepenses = $repoDepense->getXDernieresDepenses($_SESSION['exComptableEnCours']);
// Récupère les 20 derniers membres ajoutés
        $derniersMembres = $repoAdherent->getXDerniersMembres($_SESSION['exComptableEnCours'], 1, 2);

//Le controleur retourne une vue en lui passant les paramètres necessaires
        return $this->render('GestionASM17/accueil.html.twig', array(
            'exComptableEnCours' => $exComptableEnCours,
            'nbreAdherent' => $nbreAdherent,
            'nbreMembreCotiOk' => $nbreMembreCotiOk,
            'nbreMembreNokCoti' => $nbreMembreNokCoti,
            'nbreDonateur' => $nbreDonateur,
            'nbreMembreAussiDonateur' => $nbreMembreAussiDonateur,
            'totalRecette' => $totalRecette,
            'sommeParTypeDeRecette' => $sommeParTypeDeRecette,
            'totalDepense' => $totalDepense,
            'listeMembreTableauAnnivSmith' => $listeMembreTableauAnnivSmith,
            'dernieresRecettes' => $dernieresRecettes,
            'dernieresDepenses' => $dernieresDepenses,
            'derniersMembres' => $derniersMembres,
        ));
    }
}
