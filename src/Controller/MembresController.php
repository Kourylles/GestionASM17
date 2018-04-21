<?php
// GestionASM17/src/Controller/MembresController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MembresController extends Controller
{
    public function afficherMembres()
    {
        $NomMembre = "From BDD";
        $PrenomMembre = "From BDD";
        $AdresseMembre = "From BDD";
        $CpAdresseMembre ="From BDD";
        $VilleAdresseMembre = "From BDD";
        $MailMembre = "From BDD";
        $EtatCotiMembre = "From BDD";
        $DatePaiementCotiMembre = "From BDD";
        $NbreMembre = 30;

        return $this->render('GestionASM17/membres.html.twig', array(
            'NbreMembre'=>$NbreMembre,
            'NomMembre'=>$NomMembre,
            'PrenomMembre'=>$PrenomMembre,
            'AdresseMembre'=>$AdresseMembre,
            'CpAdresseMembre'=>$CpAdresseMembre,
            'VilleAdresseMembre'=>$VilleAdresseMembre,
            'MailMembre'=>$MailMembre,
            'EtatCotiMembre'=>$EtatCotiMembre,
            'DatePaiementCotiMembre'=>$DatePaiementCotiMembre
        ));
    }
}
