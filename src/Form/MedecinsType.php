<?php

namespace App\Form;

use App\Entity\Medecins;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedecinsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('specialite')
            ->add('email')
            ->add('password')
            ->add('adress')
            ->add('telephone')
            ->add('photo')
            ->add('orderNumber')
            ->add('mesRendezVous')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medecins::class,
        ]);
    }
}
