<?php

namespace App\Form;

//Composants Symfony
use Symfony\Component\OptionsResolver\OptionsResolver;

//Comosants formulaire
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

//Entité(s) utilisée(s)
use App\Entity\Smith;

class SmithType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenomSmith', TextType::class, array(
                'required' => false
            ))
            ->add('dateNaissanceSmith', DateType::class, array(
                'widget'=>'single_text',
                'required' =>false
            ))
            ->add('observationsSmith', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
            'data_class' => Smith::class,
             ]
        );
    }
}
