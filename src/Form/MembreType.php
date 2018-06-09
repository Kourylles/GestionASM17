<?php

// src/Form/MembreType.php

namespace App\Form;

//Composant Synfony
use Symfony\Component\OptionsResolver\OptionsResolver;
//Composant formulaire
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
//Entité(s) utilisée(s)
use App\Entity\Membre;
use App\Entity\LienParente;
use App\Entity\FonctionCa;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomMembre', TextType::class)
            ->add('prenomMembre', TextType::class)
            ->add('observationsMembre', TextareaType::class)
        //Imbrication du formulaire pour saisir les coordonnées
            ->add('coordonnees', CoordonneesType::class)
        //Imbrication du lien de parenté
            ->add('lienParente', EntityType::class, [
                'class' => LienParente::class,
                'choice_label' => 'lienDeParente',
                ]
            )
        //Imbrication du type de membre au Conseil d'administration
            ->add('fonctionCa', EntityType::class, [
                'class' => FonctionCa::class,
                'choice_label' => 'fonctionDansLeCa',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
            'data_class' => Membre::class,
            ]
        );
    }
}
