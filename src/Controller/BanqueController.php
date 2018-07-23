<?php

// GestionASM17/src/Controller/BanqueController.php

namespace App\Controller;

// use symfony
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//use Doctrine
Use Doctrine\Common\Persistence\ObjectManager;

//Classes utilisées
use App\Entity\Banque;

//Repository utilisés


//Formulaire utilisé
use App\Form\BanqueType;

class BanqueController extends Controller
{
    public function ajouterBanque(
        Request $request,
        ObjectManager $entityManager
    )
    {

//Récupération du formulaire 
        $banque = new Banque();
        $formAjouterBanque =  $this->createForm(BanqueType::class, $banque);

// Analyse de la requete de soumission du formulaire
        $formAjouterBanque->handleRequest($request);

    /****************************************************************************************************
     *                  Actions réalisées si le formulaire est valide                                   *
    /****************************************************************************************************/  
//Gestion des données enregistrées dans le form: validation, affectation du nouvel exercice comptable, modifcation des membres et donateurs
        if ($formAjouterBanque->isSubmitted() && $formAjouterBanque->isValid()) {
            
//Stockage dans la base de données
        $entityManager->persist($banque);
        $entityManager->flush($banque);
 
//Création du message de bonne exécution de l'enregistrement
        $this->addFlash(
            'notice',
            'La Banque a été ajoutée'
        );

//Redirection sur la page d'accueil
    return $this->redirectToRoute('accueil');
}   

    //Le controleur retourne une vue en lui passant les paramètres : form et exo comptable en cours
        return $this->render('GestionASM17/ajouterBanque.html.twig', 
            [
            'formAjouterBanque' => $formAjouterBanque->createView(),
            ]);
    }
}
