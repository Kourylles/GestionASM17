<?php
// GestionASM17/src/Controller/MembresController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Membre;

class MembresController extends Controller
{
    public function afficherMembres()
    {
        $EtatCotiMembre = "A Jour";
        $DatePaiementCotiMembre = "20/03/2018";
//Récupère sous forme de tableau les Membres et leurs adresses
        $ListeMembreEtAdresse = $this->getDoctrine()
        ->getRepository(Membre::class)
        ->getMembresEtAdresses();

        return $this->render('GestionASM17/membres.html.twig', array(

            'ListeMembresEtAdresses'=>$ListeMembreEtAdresse,
            'EtatCotiMembre'=>$EtatCotiMembre,
            'DatePaiementCotiMembre'=>$DatePaiementCotiMembre
            
        ));
    }
}
