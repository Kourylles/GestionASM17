<?php
// GestionASM17/src/Controller/ProController.php
namespace App\Controller;

//Use Symfony
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

//Entitées utilisées
use App\Entity\Professionnel;
use App\Entity\Coordonnees;

//Repositories utilisées
use App\Repository\ProfessionnelRepository;
use App\Repository\CoordonneesRepository;

class ProfessionnelsController extends Controller
{
       
    public function afficherProfessionnels(ProfessionnelRepository $repoPro)
    {

//Récupère sous forme de tableau les Professionnels et leurs adresses
        $listeProEtAdresse = $repoPro->getProEtAdresses();

//Le controleur retourne une vue en lui passant le paramètre necessaire
        return $this->render('GestionASM17/professionnels.html.twig', array(
            'listeProEtAdresse'=>$listeProEtAdresse
        ));
    }

    public function detailProfessionnels(
        $id,
        ProfessionnelRepository $repoPro,
        CoordonneesRepository $repoCoordonnees)
    {
//Récupère les données du Professionnel passé en paramètre dans une instance de professionnel
        $Pro = $repoPro->find($id);  
// Récupère les coordonnées du Professionnel passé en paramètre
        $coordonnees = $repoCoordonnees->find($Pro->getCoordonnees());  
  
//Le controleur retourne une vue en lui passant le paramètre necessaire
        return $this->render('GestionASM17/detailProfessionnels.html.twig', array(
            'Pro'=>$Pro ,
            'coordonnees'=>$coordonnees
        ));
    }



}
