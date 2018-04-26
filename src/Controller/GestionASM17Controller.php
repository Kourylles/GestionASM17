<?php
// GestionASM17/src/Controller/GestionASM17Controller.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Personne;

class GestionASM17Controller extends Controller
{
    public function accueil()
    {
        $NbreMembre= $this->getDoctrine()
        ->getRepository(Personne::class)
        ->CountTypePersonne(1);
    
        //$NbreMembre = "BDD";
        $NbreMembreOkCoti = "BDD";
        $NbreMembreNokCoti ="Calcul";
        $NbreDonateur ="BDD";
        $TotalRecette ="BDD";
        $TotalCoti ="BDD";
        $TotalDon="BDD";
        $TotalRecette="BDD";
        $TotalSubvention="BDD";
        $TotalDepense="BDD";

        return $this->render('GestionASM17/accueil.html.twig', array(
            'NbreMembre'=>$NbreMembre,
            'NbreMembreOkCoti'=>$NbreMembreOkCoti,
            'NbreMembreNokCoti'=>$NbreMembreOkCoti,
            'NbreDonateur'=>$NbreDonateur,
            'TotalRecette'=>$TotalRecette,
            'TotalCoti'=>$TotalCoti,
            'TotalDon'=>$TotalDon,
            'TotalRecette'=>$TotalRecette,
            'TotalSubvention'=>$TotalSubvention,
            'TotalDepense'=>$TotalDepense

        ));
    }
}
