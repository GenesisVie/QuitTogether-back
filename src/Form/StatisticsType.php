<?php

namespace App\Form;

use App\Entity\Statistics;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatisticsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('image')
            ->add('updatedAt')
            ->add('moneyEconomised')
            ->add('lifetimeSaved')
            ->add('unsmokedCigarette')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Statistics::class,
        ]);
    }
}
