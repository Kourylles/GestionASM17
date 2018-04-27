<?php
// GestionASM17/src/Controller/GestionASM17Controller.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Personne;
use App\Entity\Membre;
use App\Entity\ExerciceComptableDeReference;
use App\Entity\Smith;

class GestionASM17Controller extends Controller
{
    public function accueil()
    {
        $ExerciceComptabe = $this->getDoctrine()
        ->getRepository(ExerciceComptableDeReference::class)
        ->find(1);
    /*Récupération des données dans la BDD*/
        //Type de Personne : 1-Membre, 2-Donateur, 3-professionnel
        $NbreMembre= $this->getDoctrine()
        ->getRepository(Membre::class)
        ->CountByMembre();
        $ListeMembre = $this->getDoctrine()
        ->getRepository(Membre::class)
        ->findAll();
        $NbreMembreOkCoti = "9999";
        $NbreMembreNokCoti ="Calcul";
        $NbreDonateur ="9999";
        $TotalRecette ="99999";
        $SommeDesCoti ="99999";
        $SommeDesDon="99999";
        $SommeDesRecette="99999";
        $SommeDesSubvention="99999";
        $TotalDepense="99999";
        $ListeSmith = $this->getDoctrine()
        ->getRepository(Smith::class)
        ->findAll();
        $DatePlusUnMois = date('Y-m-d', strtotime('+1 week'));

        return $this->render('GestionASM17/accueil.html.twig', array(
            'ExerciceComptable'=>$ExerciceComptabe,
            'NbreMembre'=>$NbreMembre,
            'ListeMembre'=>$ListeMembre,
            'NbreMembreOkCoti'=>$NbreMembreOkCoti,
            'NbreMembreNokCoti'=>$NbreMembreOkCoti,
            'NbreDonateur'=>$NbreDonateur,
            'TotalRecette'=>$TotalRecette,
            'SommeDesCoti'=>$SommeDesCoti,
            'SommeDesDon'=>$SommeDesDon,
            'SommeDesRecette'=>$SommeDesRecette,
            'SommeDesSubvention'=>$SommeDesSubvention,
            'TotalDepense'=>$TotalDepense,
            'ListeSmith'=>$ListeSmith,
            'DatePlusUnMois'=>$DatePlusUnMois

        ));
    }
}
