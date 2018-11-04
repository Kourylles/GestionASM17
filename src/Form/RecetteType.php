<?php

// src/Form/RecetteType.php

namespace App\Form;

//Composant  Symfony
use Symfony\Component\OptionsResolver\OptionsResolver;

//Composant formulaire
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

//Composant Doctrine
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

//Entité utilisée
use App\Entity\Recette;
use App\Entity\ModePaiement;
use App\Entity\Adherent;
use App\Entity\Banque;


class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descriptionRecette',TextareaType::class)
            ->add('datePaiementRecette',DateType::class, 
                [
                'widget'=>'single_text',
                ]
            )
            ->add('adherent', AdherentType::class)
            ->add('montantRecette', NumberType::class)
            ->add('numTitrePaiementRecette', TextType::class)
            ->add('numRemiseDeChequeRecette', TextType::class)

            //Imbrication du Mode de paiement
            ->add('modePaiement', EntityType::class, 
                [
                'class'=>ModePaiement::class,
                'choice_label'=>'modeDePaiement',
                ]
            )

            //Imbrication du nom de la Banque
            ->add('banque', EntityType::class, 
                [
                'class'=>Banque::class,
                'choice_label'=>'nomBanque',
                ]
            )
            
            ;
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
