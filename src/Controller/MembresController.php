<?php
// GestionASM17/src/Controller/MembresController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Membre;
use App\Entity\Coordonnees;

class MembresController extends Controller
{
    public function afficherMembres()
    {
        $DatePaiementCotiMembre = "20/03/2018";
//Récupère sous forme de tableau les Membres et leurs adresses
        $ListeMembreEtAdresse = $this->getDoctrine()
        ->getRepository(Membre::class)
        ->getMembresEtAdresses();

        return $this->render('GestionASM17/membres.html.twig', array(
            'ListeMembresEtAdresses'=>$ListeMembreEtAdresse,
            'DatePaiementCotiMembre'=>$DatePaiementCotiMembre 
        ));
    }

    public function detailMembres($id)
    {

//Récupère les données du membre passé en paramètre dans une instance de membre
        $Membre = $this->getDoctrine()
        ->getRepository(Membre::class)
        ->find($id);

       

// Récupère les coordonnées du membres passé en paramètre
        $Coordonnees = $this->getDoctrine()
        ->getRepository(Coordonnees::class)
        ->find($Membre->getCoordonnees());



        return $this->render('GestionASM17/detailMembre.html.twig', array(
            'Membre'=>$Membre,
            'Coordonnees'=>$Coordonnees
            
        ));
    }



}
