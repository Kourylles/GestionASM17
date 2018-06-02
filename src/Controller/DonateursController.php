<?php
// GestionASM17/src/Controller/DonateursController.php
namespace App\Controller;

//Use Symfony
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

//Entitées utilisées
use App\Entity\Donateur;
use App\Entity\Coordonnees;
use App\Entity\ExerciceComptableEnCours;
use App\Entity\Recette;

//Repositories utilisées
use App\Repository\DonateurRepository;
use App\Repository\ExerciceComptableEnCoursRepository;
use App\Repository\DonateursRepository;
use App\Repository\CoordonneesRepository;
use App\Repository\RecetteRepository;


class DonateursController extends Controller
{
    public function afficherDonateurs(DonateurRepository $repoDonateur)
    {
//Récupère sous forme de tableau les Donateurs et leurs adresses
                $listeDonateurEtAdresse = $repoDonateur->getDonateursEtAdresses();

//Le controleur retourne une vue en lui passant les paramètres : form et exo comptable en cours
                return $this->render('GestionASM17/donateurs.html.twig', array(
                    'listeDonateurEtAdresse'=>$listeDonateurEtAdresse
                ));
        }

    public function detailDonateurs(
            $id,
            ExerciceComptableEnCoursRepository $exoComptEnCours,
            DonateurRepository $repoDonateur,
            CoordonneesRepository $repoCoordonnees,
            RecetteRepository $repoRecette)
    {
//Récupération de l'exercice comptable
        $exComptableEnCours = $exoComptEnCours->findExComptableEnCours(); //une seule ligne dans la base avec id=1
//Récupère les données du donateur passé en paramètre dans une instance de donateur
        $donateur = $repoDonateur->find($id);       
// Récupère les coordonnées du donateur passé en paramètre
        $coordonnees = $repoCoordonnees->find($donateur->getCoordonnees());
//Récupère toutes les recettes du donateur dont l'Id est passé en paramètre dans la route
        $recettes = $repoRecette->findByIdDonateur($donateur->getId(),$exComptableEnCours->getExerciceEnCours());
  
//Le controleur retourne une vue en lui passant les paramètres necessaires
        return $this->render('GestionASM17/detailDonateur.html.twig', array(
            'exComptableEnCours'=>$exComptableEnCours,
            'donateur'=>$donateur ,
            'coordonnees'=>$coordonnees ,
            'recettes'=>$recettes 
        ));
    }
}
