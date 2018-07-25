<?php

//src/Form/DepenseType.php

namespace App\Form;

//Composants Symfony
use Symfony\Component\OptionsResolver\OptionsResolver;

//Composants Form
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

//Composant Doctrine
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

//Use Entity
use App\Entity\ModePaiement;
use App\Entity\PosteAnalytique;
use App\Entity\TypeCompteBancaire;
use App\Entity\Depense;
use App\Entity\Tresorerie;
// use App\Entity\ExoComptPrecedent;


class DepenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextareaType::class)
            ->add('dateDepense', DateType::class,
                [
                'widget'=>'single_text',
                ]
            )
            ->add('montantDepense', MoneyType::class)
            ->add('debiteur', TextType::class)
            ->add('numTitrePaiementDepense', TextType::class)
            ->add('numReleveBancaireDepense', TextType::class)
            ->add('anneeDepense',TextType::class)
            // ->add('anneeDepense', EntityType::class,
            //         [
            //         'class' => ExoComptPrecedent::class,
            //         'choice_label' => 'exComptPrecedent'
            //         ]
            //     )
            ->add('numFacture', TextType::class)
            //Imbrication du mode de Paiement
            ->add('modePaiementDepense', EntityType::class,
                [
                'class' => ModePaiement::class,
                'choice_label' => 'modeDePaiement'
                ]
            )
            //Imbrication du poste Analytique
            ->add('posteAnalytique',EntityType::class,
                [
                'class' => PosteAnalytique::class,
                'choice_label' => 'posteAnalytique'
                ]
            )
            //Imbrication du type de compte Bancaire
            ->add('compteDebite', EntityType::class,
                [
                'class' => Tresorerie::class,
                'choice_label' => 'compteDebite'
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
            'data_class' => Depense::class,
            ]
    );
    }
}
