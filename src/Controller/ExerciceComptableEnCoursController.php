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
use App\Repository\MembreRepository;
use App\Repository\DonateurRepository;

//Formulaire utilisé
use App\Form\ExerciceComptableEnCoursType;


class ExerciceComptableEnCoursController extends Controller
{
       
    public function changerExerciceComptable(
        Request $request,
        ObjectManager $entityManager,
        ExerciceComptableEnCoursRepository $repoExComptableEnCours, 
        MembreRepository $repoMembre,
        DonateurRepository $repoDonateur    
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

//****Modification de l'état de cotisation des membres : passage du champ Etat_coti de True à false****
//Récupération des membres dont la coti est Ok
        $listeMembreAJour = $repoMembre->findBy(array('CotiOK' => '1'));

//Le champ cotiOk de chaque Membre retourné est passé à false
                foreach($listeMembreAJour as $membre)
                {
                $membre->setCotiOk(False);
                $entityManager->persist($membre);
                $entityManager->flush($membre);
                }

//Récupération des donateurs dont la coti est Ok
         $listeDonateurAJour = $repoDonateur->findBy(array('donOK' => '1'));

//Le champ CotiOk de chaque Membre retourné est passé à false
            foreach($listeDonateurAJour as $donateur)
            {
              $donateur->setDonOk(False);
              $entityManager->persist($donateur);
              $entityManager->flush($donateur);
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
