<?php

// src/Form/RapprocherDepenseType.php

namespace App\Form;

//Composant Synfony
use Symfony\Component\OptionsResolver\OptionsResolver;

//Composant formulaire
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
// use Symfony\Component\Form\Extension\Core\Type\TextareaType;
// use Symfony\Component\Form\Extension\Core\Type\DateType;
// use Symfony\Bridge\Doctrine\Form\Type\EntityType;

//Entité(s) utilisée(s)
use App\Entity\Depense;


class RapprocherDepenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numTitrePaiementDepense', TextType::class)
            ->add('numReleveBancaireDepense', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Depense::class,
        ]);
    }
}
