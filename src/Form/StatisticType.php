<?php

namespace App\Form;

use App\Entity\UserStat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatisticType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('date')
            ->add('moneyEconomised')
            ->add('cigarettesSaved')
            ->add('since')
            ->add('lifetimeSaved')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserStat::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ]);
    }
}
