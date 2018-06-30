<?php
// GestionASM17/src/Controller/ExerciceComptableEnCoursController.php

namespace App\Controller;

// use symfony
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//use Doctrine
Use Doctrine\Common\Persistence\ObjectManager;

//Classes utilisées
use App\Entity\ExerciceComptableEnCours;

//Repository utilisés
use App\Repository\ExerciceComptableEnCoursRepository;
use App\Repository\AdherentRepository;
use App\Repository\RecetteRepository;
use App\Repository\DepenseRepository;


//Formulaire utilisé
use App\Form\ExerciceComptableEnCoursType;


class ExerciceComptableEnCoursController extends Controller
{
       
    public function changerExerciceComptable(
        Request $request,
        ObjectManager $entityManager,
        ExerciceComptableEnCoursRepository $repoExComptableEnCours, 
        AdherentRepository $repoAdherent,
        RecetteRepository $repoRecette,
        DepenseRepository $repoDepense
        // MembreRepository $repoMembre,
        // DonateurRepository $repoDonateur    
        )
    {
//Récupération de l'exercice comptable la table contient une seule ligne avec id=1
        $exComptableEnCours = $repoExComptableEnCours->findExComptableEnCours(); 

//Récupération du formulaire avec en paramètre, l'exercice comptabele récupéré qui sera modifié
        $formChangeExCompt =  $this->createForm(ExerciceComptableEnCoursType::class, $exComptableEnCours);

// Analyse de la requete de soumission du formulaire
        $formChangeExCompt->handleRequest($request);

//Gestion des données enregistrées dans le form: validation, affectation du nouvel exercice comptable, modifcation des membres et donateurs
        if ($formChangeExCompt->isSubmitted() && $formChangeExCompt->isValid()) {
            $exComptableEnCours ->setDateDeModif(new \DateTime());

/****************************************************************************************************
 *    Modification de l'état de cotisation des adhérents : passage du champ Actif de True à False   *
/****************************************************************************************************/
//Récupération des adhérents actifs 
        $listeAdherentsActif = $repoAdherent->findBy(array('actif' => '1'));
//Le champ Actif de chaque Adhérent retourné est passé à false
                foreach($listeAdherentsActif as $adherent)
                {
                $adherent->setActif(False);
                $entityManager->persist($adherent);
                $entityManager->flush($adherent);
                }

/*******************************************************************************************
 *    Modification de l'état des recettes : passage du champ recette_active True à False   *
/*******************************************************************************************/
//Récupération des recettes actives 
        $listeRecettesActives = $repoRecette->findBy(array('recetteActive' => '1'));
//Le champ Actif de chaque recette retournée est passé à false
                foreach($listeRecettesActives as $recette)
                {
                $recette->setRecetteActive(False);
                $entityManager->persist($recette);
                $entityManager->flush($recette);
                }

/**********************************************************************************************
 *    Modification de l'état des dépenses : passage du champ depense_active de True à False   *
/**********************************************************************************************/
//Récupération des dépenses actives 
        $listeDepenseActives = $repoDepense->findBy(array('depenseActive' => '1'));
//Le champ Actif de chaque dépense retournée est passé à false
                foreach($listeDepenseActives as $depense)
                {
                $depense->setDepenseActive(False);
                $entityManager->persist($depense);
                $entityManager->flush($depense);
                }

//Stockage dans la base de données
               $entityManager->persist($exComptableEnCours);
               $entityManager->flush($exComptableEnCours);
         
//Affichage du message de bonne exécution de l'enregistrement
                 $session=$request->getSession()->getFlashBag()->add('info', 'L\'exercice comptable a été modifié');

//Redirection sur la page d'accueil
            return $this->redirectToRoute('accueil');
        }   
        
//Le controleur retourne une vue en lui passant les paramètres : form et exo comptable en cours
        return $this->render('GestionASM17/modifExoComptable.html.twig', array(
                'formChangeExCompt' => $formChangeExCompt->createView(),
                'exComptableEnCours' =>$exComptableEnCours
        ));
    }
}


