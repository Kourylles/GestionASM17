<?php
// GestionASM17/src/Controller/ProController.php
namespace App\Controller;

//Use Symfony
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

//Entitées utilisées
use App\Entity\Professionnel;
use App\Entity\Adherent;
use App\Entity\Coordonnees;

//Repositories utilisées
use App\Repository\ProfessionnelRepository;
use App\Repository\AdherentRepository;
use App\Repository\CoordonneesRepository;

class ProfessionnelsController extends Controller
{
       
public function afficherProfessionnels(AdherentRepository $repoAdherent)
    {

//Récupère sous forme de tableau les Professionnels et leurs adresses
        $listeProEtAdresse = $repoAdherent->getProEtAdresses();

//Le controleur retourne une vue en lui passant le paramètre necessaire
        return $this->render('GestionASM17/professionnels.html.twig', array(
            'listeProEtAdresse'=>$listeProEtAdresse
        ));
    }

    public function detailProfessionnels(
        $id,
        ProfessionnelRepository $repoAdherent,
        CoordonneesRepository $repoCoordonnees)
    {
//Récupère les données du Professionnel passé en paramètre dans une instance de professionnel
        $pro = $repoAdherent->find($id);  
// Récupère les coordonnées du Professionnel passé en paramètre
        $coordonnees = $repoCoordonnees->find($pro->getCoordonnees());  
  
//Le controleur retourne une vue en lui passant le paramètre necessaire
        return $this->render('GestionASM17/detailProfessionnels.html.twig', array(
            'pro'=>$pro ,
            'coordonnees'=>$coordonnees
        ));
    }



}
