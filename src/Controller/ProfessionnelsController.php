<?php
// GestionASM17/src/Controller/ProController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Professionnel;
use App\Entity\Coordonnees;


class ProfessionnelsController extends Controller
{
       
    public function afficherProfessionnels()
    {

//Récupère sous forme de tableau les Professionnels et leurs adresses
        $ListeProEtAdresse = $this->getDoctrine()
        ->getRepository(Professionnel::class)
        ->getProEtAdresses();

        return $this->render('GestionASM17/professionnels.html.twig', array(
            'ListeProEtAdresse'=>$ListeProEtAdresse
        ));
    }

    public function detailProfessionnels($id)
    {
//Récupère les données du Professionnel passé en paramètre dans une instance de professionnel
        $Pro = $this->getDoctrine()
        ->getRepository(Professionnel::class)
        ->find($id);  

// Récupère les coordonnées du Professionnel passé en paramètre
        $Coordonnees = $this->getDoctrine()
        ->getRepository(Coordonnees::class)
        ->find($Pro->getCoordonnees());  
  
//Renvoi de la vue
        return $this->render('GestionASM17/detailProfessionnels.html.twig', array(
            'Pro'=>$Pro ,
            'Coordonnees'=>$Coordonnees
        ));
    }



}
