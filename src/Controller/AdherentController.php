<?php

//GestionASM17/src/Controller/AdherentController.php

namespace App\Controller;

//Composant Symfony
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//Composant Doctrine
Use Doctrine\Common\Persistence\ObjectManager;

//Use Entity
use App\Entity\Adherent;
use App\Entity\ExerciceComptableEnCours;
use App\Entity\Coordonnees;
use App\Entity\LienParente;
use App\Entity\FonctionCa;
use App\Entity\Recette;
use App\Entity\Smith;

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

//Use Form
use App\Form\RecetteType;
use App\Form\SmithType;


class AdherentController extends Controller
{
    public function ajouterNouveauMembre(
        Request $request,
        ObjectManager $entityManager,
        ExerciceComptableEnCoursRepository $repoExComptableEnCours,
        MontantCotisationRepository $repoMontantCoti,
        TypeRecetteRepository $repoTypeRecette
    ) {

        //Récupération des types de recette
        $typeRecette = $repoTypeRecette->findAll();

        //Récupération du montant de la cotisation
        $montantCotisation = $repoMontantCoti->find(1);

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
            //Type de recette initialisé à 1-Adhésion
                //Séparation des données => Création d'une recette cotisation et d'une recette don si montant>25€
                if ($recette->getMontantRecette()>$montantCotisation->getMontantCotisation()){
                        $recette->setTypeRecette($typeRecette[1]);
                        $recette->setMontantRecette($recette->getMontantRecette()-$montantCotisation->getMontantCotisation());
                        $recetteCoti = clone $recette;
                        $recette->setTypeRecette($typeRecette[0]);
                        $recetteCoti->setMontantRecette($montantCotisation->getMontantCotisation());

        //Initialisation des proriété de l'adhérent
        $adherent->setTypeAdherent(1); //type d'adhérent = Membre 
        $adherent->setActif(1);
        $adherent->setDateCreation(date());
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
        return $this->render('GestionASM17/detailMembre.html.twig', array('id' =>$recette->getAdherent())) ;
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
