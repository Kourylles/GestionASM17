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
use App\Repository\BanqueRepository;
use App\Repository\TypeRecetteRepository;
use App\Repository\AdherentRepository;

//Use Form
use App\Form\RecetteType;
use App\Form\RapprocherRecetteType;







class RecetteController extends Controller
{
    public function afficherRecettes(
        RecetteRepository $repoRecette,
        TypeRecetteRepository $repoTypeRecette,
        AdherentRepository $repoAdherent
        ) 
        {
            //Récupère sous forme de tableau toutes les dépenses
            $listeRecettes = $repoRecette->getToutesLesRecettes();
            //Récupère le libellé des type de recettes 
            $typeRecette = $repoTypeRecette->findAll();
            

            //Le controleur retourne une vue en lui passant la liste des dépenses en paramètre
            return $this->render(
                'GestionASM17/recettes.html.twig', 
                    [
                    'listeRecettes'=>$listeRecettes,
                    'exComptableEnCours'=>$_SESSION['exComptableEnCours'],
                    'typeRecette'=>$typeRecette
                    ]
            );
        }
    
    public function detailRecettes(
        $id, 
        RecetteRepository $repoRecette,
        ModePaiementRepository $repoModePaiement,
        TresorerieRepository $repoTresorerie,
        BanqueRepository $repoBanque
        ) {
           //Récupère les données de la recette dans une instance de Recette
           dump($id);
            $recette = $repoRecette->find($id);  
            dump ($recette);
            //Récupère le libellé du mode de paiement de la recette
            $modePaiement = $repoModePaiement->find($recette->getModePaiement());
            //Récupère le libellé du compte sur lequel la recette a été tirée 
           // $tresorerie = $repoTresorerie->find($recette->getCompteDebite());
            //Récupère le libellé de la recette 
            $banque = $repoBanque->find($recette->getBanque());
            //Le controleur retourne une vue en lui passant des paramètres 
            return $this->render(
                'GestionASM17/detailRecette.html.twig', 
                    [
                    'exComptableEnCours'=>$_SESSION['exComptableEnCours'],
                    'recette'=>$recette ,
                    'modePaiement'=>$modePaiement ,
                    //'tresorerie'=>$tresorerie ,
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

        public function listeRecettesNonRapprochees(
            Request $request,
            ObjectManager $entityManager,
            RecetteRepository $repoRecette
            ) {
                //Récupérer la liste des dépenses non rapprochées
                $listeRecettesNonRapprochees = $repoRecette->getRecettesNonRapprochees(); 

                return $this->render(
                    'GestionASM17/listeRecettesNonRapprochees.html.twig', 
                        [
                        'listeRecettesNonRapprochees'=>$listeRecettesNonRapprochees,
                        'exComptableEnCours' =>$_SESSION['exComptableEnCours']
                        ]
                );
              }

              public function rapprocherRecettes(
                $id, 
                Request $request,
                ObjectManager $entityManager,
                RecetteRepository $repoRecette,
                ModePaiementRepository $repoModePaiement,
                TresorerieRepository $repoTresorerie
                ) {
                   //Récupère les données de la dépenses dans une instance de Depense
                    $recette = $repoRecette->find($id);  
                    dump($recette);

                    //Récupère le libellé du mode de paiement de la dépense
                    $modePaiement =$repoModePaiement->find($recette->getModePaiement());

                    //Récupère le libellé du compte sur lequel la dépense a été tirée 
                   // $tresorerie =$repoTresorerie->find($recette->getCompteDebite());
    
                    //Récupération du formulaire
                    $formRapprocherRecette = $this->createForm(RapprocherRecetteType::class, $recette);
    
                    //Analyse de la requete de soumission du formulaire
                    $formRapprocherRecette->handleRequest($request);
    
                    //Persitance du formulaire
                     if ($formRapprocherRecette->isSubmitted() && $formRapprocherRecette->isValid()) 
                      {
                        //Passage à l'état rapprochée de la dépense
                        $recette->setEtatRapprochementRecette(true);
                        //Enregistrement des objets dans la base de données
                        $entityManager->persist($recette);
                        $entityManager->flush();
    
                        //Redirige vers la page de la dépense rapprochée
                        return $this->redirectToRoute('detail_recettes', 
                            [
                            'id'=>$recette->getId()
                            ]
                            );
                      }   

                    //Le controleur retourne une vue en lui passant des paramètres 
                    return $this->render(
                        'GestionASM17/rapprocherRecettes.html.twig', 
                            [
                            'exComptableEnCours'=>$_SESSION['exComptableEnCours'],
                            'recette'=>$recette ,
                            'modePaiement'=>$modePaiement ,
                            //'tresorerie'=>$tresorerie ,
                            'formRapprocherRecette'=>$formRapprocherRecette->createView()
                            ]
                    );
                }
}
