<?php

//GestionASM17/src/Controller/DepenseController.php

namespace App\Controller;

//Composant Symfony
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


//Composant Doctrine
Use Doctrine\Common\Persistence\ObjectManager;

//use Entity
use App\Entity\Depense;
use App\Entity\ModePaiement;
use App\Entity\Tresorerie;

//Use Repository
use App\Repository\DepenseRepository;
use App\Repository\ModePaiementRepository;
use App\Repository\TresorerieRepository;

//Use Form
use App\Form\DepenseType;




class DepenseController extends Controller
{
    public function afficherDepenses(DepenseRepository $repoDepense) 
        {
            //Récupère sous forme de tableau toutes les dépenses
            $listeDepenses = $repoDepense->getToutesLesDepenses();

            //Le controleur retourne une vue en lui passant la liste des dépenses en paramètre
            return $this->render(
                'GestionASM17/depenses.html.twig', 
                    [
                    'listeDepenses'=>$listeDepenses,
                    'exComptableEnCours'=>$_SESSION['exComptableEnCours']
                    ]
            );
        }
    
    public function detailDepenses(
        $id, 
        DepenseRepository $repoDepense,
        ModePaiementRepository $repoModePaiement,
        TresorerieRepository $repoTresorerie
        ) {
           //Récupère les données de la dépenses dans une instance de Depense
            $depense = $repoDepense->find($id);  
            //Récupère le libellé du mode de paiement de la dépense
            $modePaiement =$repoModePaiement->find($depense->getModePaiementDepense());
            //Récupère le libellé du compte sur lequel la dépense a été tirée 
            $tresorerie =$repoTresorerie->find($depense->getCompteDebite());
            //Le controleur retourne une vue en lui passant des paramètres 
            return $this->render(
                'GestionASM17/detailDepense.html.twig', 
                    [
                    'exComptableEnCours'=>$_SESSION['exComptableEnCours'],
                    'depense'=>$depense ,
                    'modePaiement'=>$modePaiement ,
                    'tresorerie'=>$tresorerie ,
                    ]
            );
        }

    public function ajouterDepense(
        Request $request,
        ObjectManager $entityManager,
        DepenseRepository $repoDepense
        ) {
        //Instanciation des objest utilisé
        $depense = new Depense();

        //Récupération du formulaire
        $formAjouterDepense = $this->createForm(DepenseType::class, $depense);

        //Analyse de la requete de soumission du formulaire
        $formAjouterDepense->handleRequest($request);

        //Persitance du formulaire
        if ($formAjouterDepense->isSubmitted() && $formAjouterDepense->isValid()) 
        {
            //Enregistrement des objets dans la base de données
            $entityManager->persist($depense);
            $entityManager->flush();

        //Redirige vers la page de la dépense ajoutée
        return $this->redirectToRoute('detail_depenses', 
            [
            'id'=>$depense->getId()
            ]
        );
        }


        return $this->render(
            'GestionASM17/AjouterDepense.html.twig', 
                [
                'formAjouterDepense' => $formAjouterDepense->createView(),
                'exComptableEnCours' =>$_SESSION['exComptableEnCours']
                ]
        );
        }
}
