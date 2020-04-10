<?php

namespace App\Form;

use App\Entity\Statistics;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class StatisticsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('imageFile', VichImageType::class,['required'=>false])
            ->add('updatedAt', DateTimeType::class)
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
