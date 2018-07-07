<?php

// GestionASM17/src/Controller/AdherentCOntroller.php

namespace App\Controller;

//Composant Symfony
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//Composant Doctrine
Use Doctrine\Common\Persistence\ObjectManager;

//Entitées utilisées
use App\Entity\Adherent;
use App\Entity\ExerciceComptableEnCours;
use App\Entity\Coordonnees;
use App\Entity\LienParente;
use App\Entity\FonctionCa;
use App\Entity\Recette;
use App\Entity\Smith;

//Repositories utilisés
use App\Repository\AdherentRepository;
use App\Repository\ExerciceComptableEnCoursRepository;
use App\Repository\CoordonneesRepository;
use App\Repository\LienParenteRepository;
use App\Repository\FonctionCaRepository;
use App\Repository\RecetteRepository;
use App\Repository\SmithRepository;
use App\Repository\MontantCotisationRepository;
use App\Repository\TypeRecetteRepository;

//Formulaire utilisé
use App\Form\AdherentType;
use App\Form\RecetteNewMembreType;
use App\Form\SmithType;


class AdherentController extends Controller
{
    public function ajouterAdherent(
        Request $request,
        ObjectManager $entityManager,
        ExerciceComptableEnCoursRepository $repoExComptableEnCours,
        MontantCotisationRepository $repoMontantCoti,
        TypeRecetteRepository $repoTypeRecette
    ) {
        //Récupération dc l'exercice comptable en cours
        $exComptableEnCours = $repoExComptableEnCours->findExComptableEnCours();

        //Récupération des types de recette
        $typeRecette = $repoTypeRecette->findAll();

        //Récupération du montant de la cotisation
        $montantCotisation = $repoMontantCoti->find(1);

        //Instanciation des objets utilisés
        $recette = new Recette();

        //Récupération des formulaires
        $formAjouterRecette = $this->createForm(RecetteNewMembreType::class, $recette);

        // Analyse de la requete de soumission des formulaires
        $formAjouterRecette->handleRequest($request);

        //Si le formulaire est soumis
        if ($formAjouterRecette ->isSubmitted() ){
            //l'exercice comptable de la recette est initialisé à l'exercice comptable en cours
            $recette->setexerciceComptableRecette($exComptableEnCours->getExerciceEnCours());
                //Séparation des données => Création d'une cotisation et d'un don si montant>25€
                if ($recette->getMontantRecette()>$montantCotisation->getMontantCotisation()){
                        $recette->setTypeRecette($typeRecette[1]);
                        $recette->setMontantRecette($recette->getMontantRecette()-$montantCotisation->getMontantCotisation());
                        $recetteCoti = clone $recette;
                        $recette->setTypeRecette($typeRecette[0]);
                        $recetteCoti->setMontantRecette($montantCotisation->getMontantCotisation());
                        
                }
        //Enregistrement des objets dans la base de données
           $entityManager->persist($recette);
           $entityManager->persist($recetteCoti);
           $entityManager->flush();
           dump($recette);
           dump($recetteCoti);
        }



        //Retourne une vue avec les paramètres : form et exo comptable en cours
        return $this->render(
            'GestionASM17/AjouterMembre.html.twig', array(
            'formAjouterRecette'=> $formAjouterRecette->createView(),          
            'exComptableEnCours' =>$exComptableEnCours
                )
        );
     
    }
    
}
