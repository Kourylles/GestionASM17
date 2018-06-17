<?php

// GestionASM17/src/Controller/MembresController.php

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
use App\Repository\MembreRepository;
use App\Repository\ExerciceComptableEnCoursRepository;
use App\Repository\CoordonneesRepository;
use App\Repository\LienParenteRepository;
use App\Repository\FonctionCaRepository;
use App\Repository\RecetteRepository;
use App\Repository\SmithRepository;
use App\Repository\MontantCotisationRepository;
use App\Repository\TypeRecetteRepository;

//Formulaire utilisé
use App\Form\MembreType;
use App\Form\RecetteNewMembreType;
use App\Form\SmithType;


class MembresController extends Controller
{
    public function afficherMembres(MembreRepository $repoMembre)
    {

        //Récupère sous forme de tableau les Membres et leurs adresses
        $listeMembreEtAdresse = $repoMembre->getMembresEtAdresses();

        //Le controleur retourne une vue en lui passant la liste des membres en paramètre
        return $this->render(
            'GestionASM17/membres.html.twig', array(
            'listeMembreEtAdresse'=>$listeMembreEtAdresse
                )
        );
    }

    public function detailMembres(
        $id,
        ExerciceComptableEnCoursRepository $repoExoComptable,
        MembreRepository $repoMembre,
        CoordonneesRepository $repoCoordonnees,
        LienParenteRepository $repoLienParente,
        FonctionCaRepository $repoFonctionCa,
        RecetteRepository $repoRecette
    ) {
        //Récupération de l'exercice comptable
        $exComptableEnCours = $repoExoComptable->findExComptableEnCours(); //une seule ligne dans la base avec id=1
        //Récupère les données du membre dans une instance de membre
        $membre = $repoMembre->find($id);  
        // Récupère les coordonnées du membres passé en paramètre
        $coordonnees = $repoCoordonnees->find($membre->getCoordonnees());
        //Récupère le libellé du lien de parenté 
        $lienDeParente =$repoLienParente->find($membre->getLienParente());

        //Récupère le libellé de la fonction CA 
        $fonctionCa =$repoFonctionCa->find($membre->getFonctionCa());

        //Récupère toutes les recettes du membre dont l'Id est dans la route
        $recettes = $repoRecette->findByIdMembre($membre->getId(), $exComptableEnCours->getExerciceEnCours());   
  
        //Le controleur retourne une vue en lui passant des paramètres 
        return $this->render(
            'GestionASM17/detailMembre.html.twig', array(
            'exComptableEnCours'=>$exComptableEnCours,
            'membre'=>$membre ,
            'coordonnees'=>$coordonnees ,
            'recettes'=>$recettes ,
            'lienDeParente'=>$lienDeParente ,
            'fonctionCa'=>$fonctionCa 
                )
        );
    }

    public function ajouterMembre(
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
