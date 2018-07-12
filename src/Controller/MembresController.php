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
//use App\Entity\ExerciceComptableEnCours;
use App\Entity\Coordonnees;
use App\Entity\LienParente;
use App\Entity\FonctionCa;
use App\Entity\Recette;
use App\Entity\Smith;

//Repositories utilisés
use App\Repository\AdherentRepository;
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
    public function afficherMembres(AdherentRepository $repoAdherent)
    {

        //Récupère sous forme de tableau les Membres et leurs adresses
        $listeMembreEtAdresse = $repoAdherent->getMembresEtAdresses();

        //Le controleur retourne une vue en lui passant la liste des membres en paramètre
        return $this->render(
            'GestionASM17/membres.html.twig', array(
            'listeMembreEtAdresse'=>$listeMembreEtAdresse
                )
        );
    }

    public function detailMembres(
        $id,
        AdherentRepository $repoAdherent,
        CoordonneesRepository $repoCoordonnees,
        LienParenteRepository $repoLienParente,
        FonctionCaRepository $repoFonctionCa,
        RecetteRepository $repoRecette
    ) {
        //Récupère les données du membre dans une instance de membre
        $membre = $repoAdherent->find($id);  
        // Récupère les coordonnées du membres passé en paramètre
        $coordonnees = $repoCoordonnees->find($membre->getCoordonnees());
        //Récupère le libellé du lien de parenté 
        $lienDeParente =$repoLienParente->find($membre->getLienParente());
        //Récupère le libellé de la fonction CA 
        $fonctionCa =$repoFonctionCa->find($membre->getFonctionAuCa());
        //Récupère toutes les recettes du membre dont l'Id est dans la route
        $recettes = $repoRecette->findByAdherent($membre->getId(), $_SESSION['exComptableEnCours']);
        //Le controleur retourne une vue en lui passant des paramètres 
        return $this->render(
            'GestionASM17/detailMembre.html.twig', array(
            'exComptableEnCours'=>$_SESSION['exComptableEnCours'],
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
        MontantCotisationRepository $repoMontantCoti,
        TypeRecetteRepository $repoTypeRecette
    ) {
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
            $recette->setexerciceComptableRecette(_SESSION['exComptableEnCours']);
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
            'exComptableEnCours' =>$_SESSION['exComptableEnCours']
                )
        );
     
    }
    
}
