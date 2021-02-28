<?php

namespace App\Form;

use App\Entity\Bestelling;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BestellingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('aantal')
            ->add('staat_klaar')
            ->add('menuitem_id')
            ->add('reservering_id')
            ->add('bon_id')
            ->add('gerecht_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bestelling::class,
        ]);
    }
}
