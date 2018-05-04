<?php

// src/Form/MembreType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Membre;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomMembre', TextType::class)
            ->add('prenomMembre', TextType::class)
            ->add('lienParente', TextType::class)
            ->add('fonctionCa', TexteType::class)
            ->add('observationMembre', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    $resolver->setDefaults(array(
        'data_class' => Membre::class,
    ));
    }
}