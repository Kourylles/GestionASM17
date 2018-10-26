<?php

// src/Form/RapprocherRecetteType.php

namespace App\Form;

//Composant Synfony
use Symfony\Component\OptionsResolver\OptionsResolver;

//Composant formulaire
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

//Entité(s) utilisée(s)
use App\Entity\Recette;


class RapprocherRecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numReleveCompteRecette', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
