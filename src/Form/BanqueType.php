<?php


namespace App\Form;

//Composant Symfony
use Symfony\Component\OptionsResolver\OptionsResolver;

//Composant Form
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

//Composant Doctrrine
use App\Entity\Banque;


class BanqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomBanque', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Banque::class,
        ]);
    }
}
