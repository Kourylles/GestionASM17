<?php

// GestionASM17/src/Controller/MembresController.php

namespace App\Controller;  

//Composants Symfony
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//Composants Doctrine
Use Doctrine\Common\Persistence\ObjectManager;

//Use Entity
use App\Entity\Adherent;
use App\Entity\ExerciceComptableEnCours;
use App\Entity\Coordonnees;
use App\Entity\LienParente;
use App\Entity\FonctionCa;
use App\Entity\Recette;
use App\Entity\Smith;
use App\Entity\TypeRecette;
use App\Entity\TypeAdherent;


//Use Repository
use App\Repository\AdherentRepository;
use App\Repository\ExerciceComptableEnCoursRepository;
use App\Repository\CoordonneesRepository;
use App\Repository\LienParenteRepository;
use App\Repository\FonctionCaRepository;
use App\Repository\RecetteRepository;
use App\Repository\SmithRepository;
use App\Repository\MontantCotisationRepository;
use App\Repository\TypeRecetteRepository;
use App\Repository\TypeAdherentRepository;

//Use Form
use App\Form\MembreType;
use App\Form\RecetteType;
use App\Form\SmithType;



class MembresController extends Controller
{
    public function afficherMembres(AdherentRepository $repoAdherent)
    {

        //Récupère sous forme de tableau les Membres et leurs adresses
        $listeMembreEtAdresse = $repoAdherent->getMembresEtAdresses();
dump($listeMembreEtAdresse);    

        //Le controleur retourne une vue en lui passant la liste des membres en paramètre
        return $this->render(
            'GestionASM17/membres.html.twig', 
                [
                'listeMembreEtAdresse'=>$listeMembreEtAdresse
                ]
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
        //Récupère les données du membre dans une instance de Membre
        $membre = $repoAdherent->find($id);  
dump($membre);
        // Récupère les coordonnées du membres passé en paramètre
        $coordonnees = $repoCoordonnees->find($membre->getCoordonnees());
dump($coordonnees);
        //Récupère le libellé du lien de parenté 
        $lienDeParente =$repoLienParente->find($membre->getLienParente());
        //Récupère le libellé de la fonction CA 
        $fonctionCa =$repoFonctionCa->find($membre->getFonctionAuCa());
        //Récupère toutes les recettes du membre dont l'Id est dans la route
        $recettes = $repoRecette->findByAdherent($membre->getId(), $_SESSION['exComptableEnCours']);
        //Le controleur retourne une vue en lui passant des paramètres 
        return $this->render(
            'GestionASM17/detailMembre.html.twig', 
                [
                'exComptableEnCours'=>$_SESSION['exComptableEnCours'],
                'membre'=>$membre ,
                'coordonnees'=>$coordonnees ,
                'recettes'=>$recettes ,
                'lienDeParente'=>$lienDeParente ,
                'fonctionCa'=>$fonctionCa 
                ]
        );
    }

    public function ajouterNouveauMembre(
        Request $request,
        ObjectManager $entityManager,
        ExerciceComptableEnCoursRepository $repoExComptableEnCours,
        TypeRecetteRepository $repoTypeRecette,
        MontantCotisationRepository $repoMontantCoti,
        TypeAdherentRepository $repoTypeAdherent
    ) {

        //Récupération des types de recette
        $typeRecette = $repoTypeRecette->findAll();

        //Récupération du montant de la cotisation
        $montantCotisation = $repoMontantCoti->find(1);

        //Récupération du type d'adhérent Membre 
        $typeAdherentMembre = $repoTypeAdherent->find(1);

        //Instanciation des objets utilisés
        $recette = new Recette();
        $adherent=new Adherent();
        

        //Récupération des formulaires
        $formAjouterRecette = $this->createForm(RecetteType::class, $recette);

        // Analyse de la requete de soumission des formulaires
        $formAjouterRecette->handleRequest($request);

        //Si le formulaire est soumis
        if ($formAjouterRecette ->isSubmitted() ){
            //l'exercice comptable de la recette est initialisé à l'exercice comptable en cours
            $recette->setexerciceComptableRecette($_SESSION['exComptableEnCours']);
            //le type d'adhérent est initialisé à "Membre"
            $adherent->setTypeAdherent($typeAdherentMembre);

                //Séparation des données => Création d'une recette cotisation et d'une recette don si montant>25€
                if ($recette->getMontantRecette()>$montantCotisation->getMontantCotisation()){
                        $recette->setTypeRecette($typeRecette[1]);
                        $recette->setMontantRecette($recette->getMontantRecette()-$montantCotisation->getMontantCotisation());
                        $recetteCoti = clone $recette;
                        $recette->setTypeRecette($typeRecette[0]);
                        $recetteCoti->setMontantRecette($montantCotisation->getMontantCotisation());

        //Enregistrement des objets dans la base de données
        $entityManager->persist($recette);
        $entityManager->persist($recetteCoti);
        $entityManager->flush();
           
        
        //Redirige vers la page de l'adhérent ajouté
        return $this->redirectToRoute('detail_membres', 
                            [
                            'id'=>$recette->getAdherent()
                            ]
                            );
                }
        //return $this->render('GestionASM17/detailMembre.html.twig', array('id' =>$recette->getAdherent())) ;}
        else {
           //il n'y a pas de don => c'est une adhésion
           $recette->setTypeRecette($typeRecette[0]);
           //Enregistrement des objets dans la base de données
           $entityManager->persist($recette);
           $entityManager->flush();
           
        
        //Redirige vers la page de l'adhérent ajouté
        return $this->redirectToRoute('detail_membres', 
            [
            'id'=>$recette->getAdherent()
            ]
            );
        }
        }


        //Retourne une vue avec les paramètres : form et exo comptable en cours
        return $this->render(
            'GestionASM17/AjouterNouveauMembre.html.twig', 
            [
            'formAjouterRecette'=> $formAjouterRecette->createView(),          
            'exComptableEnCours' =>$_SESSION['exComptableEnCours']//$exComptableEnCours
            ]
         );
     
    }
    
}
