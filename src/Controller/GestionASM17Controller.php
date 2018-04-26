<?php
// GestionASM17/src/Controller/GestionASM17Controller.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Personne;
use App\Entity\Membre;

class GestionASM17Controller extends Controller
{
    public function accueil()
    {
    /*Récupération des données dans la BDD*/
        //Type de Personne : 1-Membre, 2-Donateur, 3-professionnel
        $NbreMembre= $this->getDoctrine()
        ->getRepository(Membre::class)
        ->CountByMembre();
        $NbreMembreOkCoti = "BDD";
        $NbreMembreNokCoti ="Calcul";
        $NbreDonateur ="BDD";
        
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
