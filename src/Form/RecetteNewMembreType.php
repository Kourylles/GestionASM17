<?php

// src/Form/RecetteNewMembreType.php

namespace App\Form;

//Composant Synfony
use Symfony\Component\OptionsResolver\OptionsResolver;
//Composant formulaire
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
//Entité(s) utilisée(s)
use App\Entity\Adherent;
use App\Entity\TypeAdherent;
use App\Entity\LienParente;
use App\Entity\FonctionCa;


class RecetteNewMembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('observation', TextareaType::class)
            ->add('isSmith', ChoiceType::class, 
            array(
                'choices'  => array(
                    'Non' => false,
                    'Oui' => true,
                ),)
                )
        // Imbrication du type d'adhérent
            ->add('typeAdherent', EntityType::class, [
                'class' => TypeAdherent::class,
                'choice_label' => 'typeAdherent',
                ]
            )
        //Imbrication du formulaire pour saisir les coordonnées
            ->add('coordonnees', CoordonneesType::class)
        //Imbrication du formulaire pour saisir le Smith lié
            ->add('smithLie', SmithType::class)
        //Imbrication du lien de parenté
            ->add('lienParente', EntityType::class, [
                'class' => LienParente::class,
                'choice_label' => 'lienDeParente',
                ]
            )
        //Imbrication du type de membre au Conseil d'administration
             ->add('fonctionAuCa', EntityType::class, [
                 'class' => FonctionCa::class,
                 'choice_label' => 'fonctionDansLeCa',
                 ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
            'data_class' => Recette::class,
            ]
        );
    }
}
