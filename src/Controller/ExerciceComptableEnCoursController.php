<?php
// GestionASM17/src/Controller/ExerciceComptableEnCoursController.php

namespace App\Controller;

// use symfony
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//Classes utilisées
use App\Entity\ExerciceComptableEnCours;

//Repository utilisés
use App\Repository\ExerciceComptableEnCoursRepository;

//Formulaire utilisé
use App\Form\ExerciceComptableEnCoursType;


class ExerciceComptableEnCoursController extends Controller
{
       
    public function changerExerciceComptable(Request $request,ExerciceComptableEnCoursRepository $repoExComptableEnCours)
    {

//Récupération de l'exercice comptable la table continet une seule ligne avec id=1
$exComptableEnCours = $repoExComptableEnCours->findExComptableEnCours(); 

//Création d'une instance d'ExerciceComptableEnCours
        $nouvelExoComptable = new ExerciceComptableEnCours();
//Récupération du formulaire
        $formChangeExCompt =  $this->createForm(ExerciceComptableEnCoursType::class, $nouvelExoComptable);

        // Analyse de la requete de soumission du formulaire
        $formChangeExCompt->handleRequest($request);

//Gestion des données enregistrées dans le formulaire: validation et affectation des variables à l'objet
    if ($formChangeExCompt->isSubmitted() && $formChangeExCompt->isValid()) {
        $nouvelExoComptable
        ->setId(1)
        ->setDateDeModif(new \DateTime());
    }

//Le controleur retourne une vue en lui passant les paramètres : form et exo comptable en cours
        return $this->render('GestionASM17/modifExoComptable.html.twig', array(
            'formChangeExCompt' => $formChangeExCompt->createView(),
            'exComptableEnCours' =>$exComptableEnCours
        ));
    }

}
