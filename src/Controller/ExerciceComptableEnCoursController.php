<?php
// GestionASM17/src/Controller/ExerciceComptableEnCoursController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ExerciceComptableEnCours;
use App\Form\ExerciceComptableEnCoursType;


class ExerciceComptableEnCoursController extends Controller
{
       
    public function changerExerciceComptable(Request $request)
    {
//Création d'une instance d'ExerciceComptableEnCours
        $NouvelExoComptable = new ExerciceComptableEnCours();

//Récupération du formulaire
        $formChangeExCompt =  $this->createForm(ExerciceComptableEnCoursType::class, $NouvelExoComptable);
        $formChangeExCompt->handleRequest($request);


        return $this->render('GestionASM17/modifExoComptable.html.twig', array(
            'formChangeExCompt' => $formChangeExCompt->createView()
        ));
    }

    



}
