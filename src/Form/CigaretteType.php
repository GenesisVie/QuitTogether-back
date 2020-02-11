<?php

namespace App\Form;

use App\Entity\Cigarette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CigaretteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('feelings')
            ->add('intensity')
            ->add('reason')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cigarette::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ]);
    }
}
