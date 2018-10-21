<?php

//GestionASM17/src/Controller/RecetteController.php

namespace App\Controller;

//Composant Symfony
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


//Composant Doctrine
Use Doctrine\Common\Persistence\ObjectManager;

//use Entity
use App\Entity\Recette;
use App\Entity\ModePaiement;
use App\Entity\Tresorerie;

//Use Repository
use App\Repository\RecetteRepository;
use App\Repository\ModePaiementRepository;
use App\Repository\TresorerieRepository;
use App\Repository\ExoComptPrecedentRepository;

//Use Form
use App\Form\RecetteType;





class RecetteController extends Controller
{
    public function afficherRecettes(RecetteRepository $repoRecette) 
        {
            //Récupère sous forme de tableau toutes les dépenses
            $listeRecettes = $repoRecette->getToutesLesRecettes();

            //Le controleur retourne une vue en lui passant la liste des dépenses en paramètre
            return $this->render(
                'GestionASM17/Recettes.html.twig', 
                    [
                    'listeRecettes'=>$listeRecettes,
                    'exComptableEnCours'=>$_SESSION['exComptableEnCours']
                    ]
            );
        }
    
    public function detailRecettes(
        $id, 
        RecetteRepository $repoRecette,
        ModePaiementRepository $repoModePaiement,
        TresorerieRepository $repoTresorerie
        ) {
           //Récupère les données de la dépenses dans une instance de Recette
            $recette = $repoRecette->find($id);  
            //Récupère le libellé du mode de paiement de la dépense
            $modePaiement =$repoModePaiement->find($recette->getModePaiementRecette());
            //Récupère le libellé du compte sur lequel la dépense a été tirée 
            $tresorerie =$repoTresorerie->find($recette->getCompteDebite());
            //Le controleur retourne une vue en lui passant des paramètres 
            return $this->render(
                'GestionASM17/detailRecette.html.twig', 
                    [
                    'exComptableEnCours'=>$_SESSION['exComptableEnCours'],
                    'Recette'=>$recette ,
                    'modePaiement'=>$modePaiement ,
                    'tresorerie'=>$tresorerie ,
                    ]
            );
        }

    public function ajouterRecette(
        Request $request,
        ObjectManager $entityManager,
        RecetteRepository $repoRecette
        ) {
        //Instanciation des objets utilisés
        $recette = new Recette();

        //Récupération du formulaire
        $formAjouterRecette = $this->createForm(RecetteType::class, $recette);

        //Analyse de la requete de soumission du formulaire
        $formAjouterRecette->handleRequest($request);

        //Persitance du formulaire
        if ($formAjouterRecette->isSubmitted() && $formAjouterRecette->isValid()) 
        {dump($recette);
            //Enregistrement des objets dans la base de données
            $entityManager->persist($recette);
            $entityManager->flush();

        //Redirige vers la page de la dépense ajoutée
        return $this->redirectToRoute('detail_Recettes', 
            [
            'id'=>$recette->getId()
            ]
        );
        }

        return $this->render(
            'GestionASM17/ajouterRecette.html.twig', 
                [
                'formAjouterRecette' => $formAjouterRecette->createView(),
                'exComptableEnCours' =>$_SESSION['exComptableEnCours']
                ]
        );
        }

        public function rapprocherRecette(
            Request $request,
            ObjectManager $entityManager,
            RecetteRepository $repoRecette
            ) {
                //Instanciation des objest utilisé
                $recette = new Recette();
    
                //Récupération du formulaire
                $formRapprocherRecette = $this->createForm(RapprocherRecetteType::class, $recette);
    
                //Analyse de la requete de soumission du formulaire
                $formRapprocherRecette->handleRequest($request);
    
                //Persitance du formulaire
                if ($formRapprocherRecette->isSubmitted() && $formRapprocherRecette->isValid()) 
                {
                    //Enregistrement des objets dans la base de données
                    $entityManager->persist($recette);
                    $entityManager->flush();
    
                //Redirige vers la page de la dépense ajoutée
                return $this->redirectToRoute('rapprocher_Recette');
                }
              }
}
