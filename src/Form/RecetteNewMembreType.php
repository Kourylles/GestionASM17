<?php

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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

//Entité(s) utilisée(s)
use App\Entity\Recette;
use App\Entity\ModePaiement;

class RecetteNewMembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descriptionRecette',TextareaType::class)
            ->add('datePaiementRecette',DateType::class, array(
                'widget'=>'single_text',
            ))
            ->add('montantRecette',NumberType::class)
            ->add('numTitrePaiementRecette', TextType::class)
            ->add('numRemiseDeChequeRecette',TextType::class)
//Imbrication du Mode de paiement
            ->add('modePaiement', EntityType::class, [
                'class'=>ModePaiement::class,
                'choice_label'=>'modeDePaiement',
            ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    $resolver->setDefaults(array(
        'data_class' => Recette::class,
    ));
    }
}
