<?php
// GestionASM17/src/Controller/MembresController.php
namespace App\Controller;

//Use Symfony
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

//Entitées utilisées
use App\Entity\Membre;
use App\Entity\Coordonnees;
use App\Entity\ExerciceComptableEnCours;
use App\Entity\Smith;
use App\Entity\LienParente;
use App\Entity\FonctionCa;
use App\Entity\Recette;

//Repositories utilisés
use App\Repository\MembreRepository;
use App\Repository\ExerciceComptableEnCoursRepository;
use App\Repository\CoordonneesRepository;
use App\Repository\LienParenteRepository;
use App\Repository\FonctionCaRepository;
use App\Repository\RecetteRepository;

class MembresController extends Controller
{
    public function afficherMembres(MembreRepository $repoMembre)
    {

//Récupère sous forme de tableau les Membres et leurs adresses
        $listeMembreEtAdresse = $repoMembre->getMembresEtAdresses();

//Le controleur retourne une vue en lui passant la liste des membres en paramètre
        return $this->render('GestionASM17/membres.html.twig', array(
            'listeMembreEtAdresse'=>$listeMembreEtAdresse
        ));
        dump($listeMembreEtAdresse);die;
    }

    public function detailMembres(
            $id,
            ExerciceComptableEnCoursRepository $repoExoComptable,
            MembreRepository $repoMembre,
            CoordonneesRepository $repoCoordonnees,
            LienParenteRepository $repoLienParente,
            FonctionCaRepository $repoFonctionCa,
            RecetteRepository $repoRecette
            )
    {
//Récupération de l'exercice comptable
        $exComptableEnCours = $repoExoComptable->findExComptableEnCours(); //une seule ligne dans la base avec id=1
//Récupère les données du membre passé en paramètre dans une instance de membre
        $membre = $repoMembre->find($id);  
// Récupère les coordonnées du membres passé en paramètre
        $coordonnees = $repoCoordonnees->find($membre->getCoordonnees());
//Récupère le libellé du lien de parenté en fonction du code contenu dans l'entity membre
        $lienDeParente =$repoLienParente->find($membre->getLienParente());

        dump($lienDeParente);
//Récupère le libellé de la fonction CA en fonction du code contenu dans l'entity membre
        $fonctionCa =$repoFonctionCa->find($membre->getFonctionCa());
//Récupère toutes les recettes du membre dont l'Id est passé en paramètre dans la route
        $recettes = $repoRecette->findByIdMembre($membre->getId(),$exComptableEnCours->getExerciceEnCours());   
  
//Le controleur retourne une vue en lui passant les paramètres : form et exo comptable en cours
        return $this->render('GestionASM17/detailMembre.html.twig', array(
            'exComptableEnCours'=>$exComptableEnCours,
            'membre'=>$membre ,
            'coordonnees'=>$coordonnees ,
            'recettes'=>$recettes ,
            'lienDeParente'=>$lienDeParente ,
            'fonctionCa'=>$fonctionCa 
        ));
    }
}
