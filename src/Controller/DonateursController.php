<?php
// GestionASM17/src/Controller/DonateursController.php
namespace App\Controller;

//Use Symfony
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

//Entitées utilisées
use App\Entity\Adherent;
use App\Entity\Coordonnees;
// use App\Entity\ExerciceComptableEnCours;
use App\Entity\Recette;

//Repositories utilisées
use App\Repository\AdherentRepository;
use App\Repository\ExerciceComptableEnCoursRepository;
use App\Repository\DonateursRepository;
use App\Repository\CoordonneesRepository;
use App\Repository\RecetteRepository;


class DonateursController extends Controller
{
    public function afficherDonateurs(AdherentRepository $repoAdherent)
    {
//Récupère sous forme de tableau les Donateurs et leurs adresses
                $listeDonateurEtAdresse = $repoAdherent->getDonateursEtAdresses();

//Le controleur retourne une vue en lui passant les paramètres : form et exo comptable en cours
                return $this->render('GestionASM17/donateurs.html.twig', array(
                    'listeDonateurEtAdresse'=>$listeDonateurEtAdresse
                ));
        }

    public function detailDonateurs(
            $id,
            AdherentRepository $repoAdherent,
            CoordonneesRepository $repoCoordonnees,
            RecetteRepository $repoRecette)
    {
//Récupère les données du donateur passé en paramètre dans une instance de donateur
        $donateur = $repoAdherent->find($id);
// Récupère les coordonnées du donateur passé en paramètre
        $coordonnees = $repoCoordonnees->find($donateur->getCoordonnees());
//Récupère toutes les recettes du donateur dont l'Id est passé en paramètre dans la route
        $recettes = $repoRecette->findByAdherent($donateur->getId(), $_SESSION['exComptableEnCours']);
  
//Le controleur retourne une vue en lui passant les paramètres necessaires
        return $this->render('GestionASM17/detailDonateur.html.twig', array(
            'exComptableEnCours'=>$_SESSION['exComptableEnCours'],
            'donateur'=>$donateur ,
            'coordonnees'=>$coordonnees ,
            'recettes'=>$recettes 
        ));
    }
}
