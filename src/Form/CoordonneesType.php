<?php
// src/Form/CoordonneesType.php

namespace App\Form;

//Composant Synfony 
use Symfony\Component\OptionsResolver\OptionsResolver;

//Composant formulaire
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

//Entité(s) utilisée(s)
use App\Entity\Coordonnees;


class CoordonneesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ligneAdr1', TextType::class)
            ->add('ligneAdr2', TextType::class)
            ->add('ligneAdr3', TextType::class)
            ->add('codePostal', TextType::class)
            ->add('ville', TextType::class)
            ->add('pays', TextType::class)
            ->add('telephone1',TelType::class)
            ->add('telephone2',TelType::class)
            ->add('email1',EmailType::class)
            ->add('email2',EmailType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    $resolver->setDefaults(array(
        'data_class' => Coordonnees::class,
    ));
    }
}